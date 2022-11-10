<?php

namespace App\Service\Traits\Interfaces;

use App\Service\Interfaces\TripServiceInterface;

/**
 * TripServiceTrait interface.
 */
interface HasTripServiceInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the property TripService.
     *
     * @return TripServiceInterface TripServiceInterface
     */
    public function getTripService(): TripServiceInterface;

    /**
     * Sets the property TripService.
     *
     * @param TripServiceInterface $tripService The service of trip to set.
     *
     * @return $this $this
     */
    public function setTripService(TripServiceInterface $tripService): self;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}