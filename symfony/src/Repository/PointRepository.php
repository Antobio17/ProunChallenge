<?php

namespace App\Repository;

use App\Entity\Point;
use App\Repository\Interfaces\PointRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    /*********************************************** PUBLIC METHODS ***********************************************/

}
