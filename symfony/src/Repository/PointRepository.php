<?php

namespace App\Repository;

use App\Entity\Point;
use App\Repository\Interfaces\PointRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Point|null find($id, $lockMode = null, $lockVersion = null)
 * @method Point|null findOneBy(array $criteria, array $orderBy = null)
 * @method Point[]    findAll()
 * @method Point[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointRepository extends ServiceEntityRepository implements PointRepositoryInterface
{

    /************************************************* CONSTRUCT **************************************************/

    /**
     * PointRepository construct.
     *
     * @param ManagerRegistry $registry Manager registry to manage the doctrine.
     *
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Point::class);
    }

    /**
     * @inheritDoc
     * @return Point|null Point|null
     */
    public function findOneByPoint(Point $point): ?Point
    {
        $alias = 'poi';

        try {
            $result = $this->createQueryBuilder($alias)
                ->andWhere(sprintf('%s.name = :name', $alias))
                ->setParameter('name', $point->getName())
                ->andWhere(sprintf('%s.latitude = :latitude', $alias))
                ->setParameter('latitude', $point->getLatitude())
                ->andWhere(sprintf('%s.longitude = :longitude', $alias))
                ->setParameter('longitude', $point->getLongitude())
                ->getQuery()->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }

        return $result ?? NULL;
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

}
