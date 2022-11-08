<?php

namespace App\Entity\Interfaces;

use App\Entity\Traits\Interfaces\HasServiceLocatorInterface;
use App\Entity\Traits\Interfaces\HasUUIDInterface;
use App\Entity\Traits\Interfaces\HasVehicleInterface;

/**
 * Trip interface.
 */
interface TripInterface extends HasUUIDInterface, HasServiceLocatorInterface, HasVehicleInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the property CollectionPoint of the trip.
     *
     * @return PointInterface PointInterface
     */
    public function getCollectionPoint(): PointInterface;

    /**
     * Sets the property CollectionPoint of the trip.
     *
     * @param PointInterface $collectionPoint The collection point to set.
     *
     * @return $this $this
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setCollectionPoint(PointInterface $collectionPoint);

    /**
     * Gets the property DestinationPoint of the trip.
     *
     * @return PointInterface PointInterface
     */
    public function getDestinationPoint(): PointInterface;

    /**
     * Sets the property DestinationPoint of the trip.
     *
     * @param PointInterface $destinationPoint The destination point to set.
     *
     * @return $this $this
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setDestinationPoint(PointInterface $destinationPoint);

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Returns the entity in array format.
     *
     *      array(
     *          'uuid' => string,
     *          'collectionPoint' => Point->__toArray(),
     *          'destinationPoint' => Point->__toArray(),
     *          'serviceLocator' => string,
     *          'vehicle' => string
     *      )
     *
     * @return array array
     */
    public function __toArray(): array;

    /**
     * ToString function of the entity.
     *
     * @return string string
     */
    public function __toString(): string;

    /*********************************************** STATIC METHODS ***********************************************/

}