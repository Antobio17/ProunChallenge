<?php

namespace App\Repository;

use App\Entity\Point;
use App\Entity\Trip;
use App\Repository\Interfaces\TripRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trip[]    findAll()
 * @method Trip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripRepository extends ServiceEntityRepository implements TripRepositoryInterface
{

    /************************************************* CONSTRUCT **************************************************/

    /**
     * TripRepository construct.
     *
     * @param ManagerRegistry $registry Manager registry to manage the doctrine.
     *
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }

    /**
     * @inheritDoc
     * @return array array
     */
    public function findTripByProperties(?string $UUID, ?string $serviceLocator, ?Point $collectionPoint,
                                         ?Point  $destinationPoint): array
    {
        $alias = 'tri';

        $trips = $this->createQueryBuilder($alias);

        if ($UUID !== NULL):
            $trips->andWhere(sprintf('%s.uuid = :uuid', $alias))
                ->setParameter('uuid', $UUID);
        endif;
        if ($serviceLocator !== NULL):
            $trips->andWhere(sprintf('%s.serviceLocator = :serviceLocator', $alias))
                ->setParameter('serviceLocator', $serviceLocator);
        endif;
        if ($collectionPoint !== NULL && $collectionPoint->getID() !== NULL):
            $trips->andWhere(sprintf('%s.collectionPoint = :collectionPoint', $alias))
                ->setParameter('collectionPoint', $collectionPoint->getID());
        endif;
        if ($destinationPoint !== NULL && $destinationPoint->getID() !== NULL):
            $trips->andWhere(sprintf('%s.destinationPoint = :destinationPoint', $alias))
                ->setParameter('destinationPoint', $destinationPoint->getID());
        endif;

        $trips = $trips->getQuery()->getResult();
        foreach ($trips as $trip):
            $result[] = $trip->__toArray();
        endforeach;

        return $result ?? array();
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

}
