<?php

namespace App\Service\Interfaces;


use App\Repository\Interfaces\PointRepositoryInterface;
use App\Repository\Interfaces\TripRepositoryInterface;

interface TripServiceInterface extends AppServiceInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Facade that returns an instance of the TripRepository.
     *
     * @return TripRepositoryInterface TripRepositoryInterface
     */
    public function getTripRepository(): TripRepositoryInterface;

    /**
     * Facade that returns an instance of the PointRepository.
     *
     * @return PointRepositoryInterface PointRepositoryInterface
     */
    public function getPointRepository(): PointRepositoryInterface;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Create a new trip with the params passed.
     *
     * @param string $serviceLocator Service locator of the trip.
     * @param array $collectionPointArray Collection Point of the trip.
     * @param array $destinationPointArray Destination Point of the trip.
     * @param string $vehicle Vehicle of the trip.
     *
     * @return string|null string|null
     */
    public function createTrip(string $serviceLocator, array $collectionPointArray, array $destinationPointArray,
                               string $vehicle): ?string;

    /**
     * Finds trips from properties.
     *
     * @param string|null $UUID UUID of the trip.
     * @param string|null $serviceLocator Service locator of the trip.
     * @param array|null $collectionPointArray Collection Point of the trip.
     * @param array|null $destinationPointArray Destination Point of the trip.
     *
     * @return array array
     */
    public function getTrips(?string $UUID, ?string $serviceLocator, ?array $collectionPointArray,
                             ?array $destinationPointArray): array;

    /*********************************************** STATIC METHODS ***********************************************/

}