<?php

namespace App\Service;

use App\Controller\TripController;
use App\Entity\Point;
use App\Entity\Trip;
use App\Entity\User;
use App\Repository\Interfaces\PointRepositoryInterface;
use App\Repository\Interfaces\TripRepositoryInterface;
use App\Repository\PointRepository;
use App\Repository\TripRepository;
use App\Service\Interfaces\TripServiceInterface;
use Doctrine\Persistence\ManagerRegistry;

class TripService extends AppService implements TripServiceInterface
{

    /************************************************* CONSTANTS **************************************************/

    /************************************************* PROPERTIES *************************************************/

    /**
     * @var TripRepositoryInterface
     */
    protected TripRepositoryInterface $tripRepository;

    /**
     * @var PointRepositoryInterface
     */
    protected PointRepositoryInterface $pointRepository;

    /************************************************* CONSTRUCT **************************************************/

    /**
     * TripService construct.
     *
     * @param ManagerRegistry $doctrine Doctrine to manage the ORM.
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine);
    }

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return TripRepository TripRepository
     */
    public function getTripRepository(): TripRepository
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getEntityManager()->getRepository(Trip::class);
    }

    /**
     * @inheritDoc
     * @return PointRepository PointRepository
     */
    public function getPointRepository(): PointRepository
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getEntityManager()->getRepository(Point::class);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return string|null string|null
     */
    public function createTrip(string $serviceLocator, array $collectionPointArray, array $destinationPointArray,
                               string $vehicle): ?string
    {
        $collectionPoint = $this->_getPointFromArray($collectionPointArray);
        $destinationPoint = $this->_getPointFromArray($destinationPointArray);

        $trip = new Trip($serviceLocator, $collectionPoint, $destinationPoint, $vehicle);

        return $this->persistAndFlush($trip) ? $trip->getUUID() : NULL;
    }

    /**
     * @inheritDoc
     * @return array array
     */
    public function getTrips(?string $UUID, ?string $serviceLocator, ?array $collectionPointArray,
                             ?array  $destinationPointArray): array
    {
        if ($collectionPointArray !== NULL):
            $collectionPoint = $this->_getPointFromArray($collectionPointArray);
        endif;
        if ($destinationPointArray !== NULL):
            $destinationPoint = $this->_getPointFromArray($destinationPointArray);
        endif;

        if (($collectionPointArray === NULL || $collectionPoint->getID() !== NULL) &&
            ($destinationPointArray === NULL || $destinationPoint->getID() !== NULL)):
            $trips = $this->getTripRepository()->findTripByProperties(
                $UUID, $serviceLocator, $collectionPoint ?? NULL, $destinationPoint ?? NULL
            );
        endif;

        return $trips ?? array();
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /**
     * Get or create a point from data array.
     *
     * @param array $data The array of values of the point.
     *
     * @return Point Point
     */
    protected function _getPointFromArray(array $data): Point
    {
        $point = new Point(
            $data[TripController::REQUEST_FIELD_POINT_NAME],
            (float)$data[TripController::REQUEST_FIELD_POINT_LATITUDE],
            (float)$data[TripController::REQUEST_FIELD_POINT_LONGITUDE],
        );

        return $this->getPointRepository()->findOneByPoint($point) ?? $point;
    }

    /*********************************************** STATIC METHODS ***********************************************/

}