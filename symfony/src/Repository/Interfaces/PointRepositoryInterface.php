<?php

namespace App\Repository\Interfaces;

use App\Entity\Point;

interface PointRepositoryInterface
{

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Find if a point exist in the database.
     *
     * @param Point $point The point to search.
     *
     * @return Point|null Point|null
     */
    public function findOneByPoint(Point $point): ?Point;

}