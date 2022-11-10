<?php

namespace App\Repository\Interfaces;

use App\Entity\Point;

interface TripRepositoryInterface
{

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Finds trips from properties.
     *
     * @param string|null $UUID UUID of the trip.
     * @param string|null $serviceLocator Service locator of the trip.
     * @param Point|null $collectionPoint Collection Point of the trip.
     * @param Point|null $destinationPoint Destination Point of the trip.
     *
     * @return array array
     */
    public function findTripByProperties(?string $UUID, ?string $serviceLocator, ?Point $collectionPoint,
                                         ?Point  $destinationPoint): array;

}