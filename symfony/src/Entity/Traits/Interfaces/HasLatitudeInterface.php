<?php

namespace App\Entity\Traits\Interfaces;

/**
 * LatitudeTrait interface
 */
interface HasLatitudeInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the Latitude property.
     *
     * @return float float
     */
    public function getLatitude(): float;

    /**
     * Sets the Latitude property.
     *
     * @param float $latitude The Latitude to be set.
     *
     * @return $this $this
     */
    public function setLatitude(float $latitude): self;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * ToArray function of the property.
     *
     *      Returns array(
     *          'latitude' => $this->>getLatitude()
     *      )
     *
     * @return array array
     */
    public function __toArray(): array;

    /*********************************************** STATIC METHODS ***********************************************/

}