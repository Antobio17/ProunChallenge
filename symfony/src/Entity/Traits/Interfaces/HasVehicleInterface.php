<?php

namespace App\Entity\Traits\Interfaces;

/**
 * VehicleTrait interface
 */
interface HasVehicleInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the Vehicle property of the Entity.
     *
     * @return string string
     */
    public function getVehicle(): string;

    /**
     * Sets the Vehicle property of the Entity.
     *
     * @param string $vehicle Vehicle of the Entity to set.
     *
     * @return $this $this
     */
    public function setVehicle(string $vehicle): self;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * ToArray function of the property.
     *
     *      Returns array(
     *          'vehicle' => $this->getVehicle()
     *      )
     *
     * @return array array
     */
    public function __toArray(): array;

    /**
     * Checks if the vehicle passed exist in the system.
     *
     * @param string $vehicle The vehicle to check.
     *
     * @return bool bool
     */
    public function allowVehicle(string $vehicle): bool;

    /*********************************************** STATIC METHODS ***********************************************/

}