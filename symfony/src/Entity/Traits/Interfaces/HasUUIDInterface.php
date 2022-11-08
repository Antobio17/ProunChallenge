<?php

namespace App\Entity\Traits\Interfaces;

/**
 * UUIDTrait interface
 */
interface HasUUIDInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the UUID property of the Entity.
     *
     * @return string|null string|null
     */
    public function getUUID(): ?string;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * ToArray function of the property.
     *
     *      Returns array(
     *          'uuid' => $this->getUUID()
     *      )
     *
     * @return array array
     */
    public function __toArray(): array;

    /*********************************************** STATIC METHODS ***********************************************/

}