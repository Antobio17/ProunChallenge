<?php

namespace App\Entity\Traits\Interfaces;

/**
 * ServiceLocatorTrait interface
 */
interface HasServiceLocatorInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the ServiceLocator property of the Entity.
     *
     * @return string string
     */
    public function getServiceLocator(): string;

    /**
     * Sets the ServiceLocator property of the Entity.
     *
     * @param string $serviceLocator ServiceLocator of the Entity to set.
     *
     * @return $this $this
     */
    public function setServiceLocator(string $serviceLocator): self;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * ToArray function of the property.
     *
     *      Returns array(
     *          'serviceLocator' => $this->getServiceLocator()
     *      )
     *
     * @return array array
     */
    public function __toArray(): array;

    /*********************************************** STATIC METHODS ***********************************************/

}