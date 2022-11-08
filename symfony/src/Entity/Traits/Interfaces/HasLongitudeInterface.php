<?php

namespace App\Entity\Traits\Interfaces;

/**
 * LongitudeTrait interface
 */
interface HasLongitudeInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the Longitude property.
     *
     * @return float float
     */
    public function getLongitude(): float;

    /**
     * Sets the Longitude property.
     *
     * @param float $longitude The Longitude to be set.
     *
     * @return $this $this
     */
    public function setLongitude(float $longitude): self;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * ToArray function of the property.
     *
     *      Returns array(
     *          'longitude' => $this->>getLongitude()
     *      )
     *
     * @return array array
     */
    public function __toArray(): array;

    /*********************************************** STATIC METHODS ***********************************************/

}