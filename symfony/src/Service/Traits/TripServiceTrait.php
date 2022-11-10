<?php

namespace App\Service\Traits;

use App\Service\Interfaces\TripServiceInterface;
use App\Service\Traits\Interfaces\HasTripServiceInterface;

/**
 * Trait to implement Trip property.
 *
 * @see HasTripServiceInterface
 */
trait TripServiceTrait
{

    /************************************************* PROPERTIES *************************************************/

    /**
     * @var TripServiceInterface
     */
    protected TripServiceInterface $tripService;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return TripServiceInterface TripServiceInterface
     */
    public function getTripService(): TripServiceInterface
    {
        return $this->tripService;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setTripService(TripServiceInterface $tripService): self
    {
        $this->tripService = $tripService;

        return $this;
    }

    /************************************************* CONSTRUCT **************************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}