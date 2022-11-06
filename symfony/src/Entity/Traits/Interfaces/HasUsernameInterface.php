<?php

namespace App\Entity\Traits\Interfaces;

/**
 * UsernameTrait interface
 */
interface HasUsernameInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the Username property of the Entity.
     *
     * @return string string
     */
    public function getUsername(): string;

    /**
     * Sets the Username property of the Entity.
     *
     * @param string $username Username of the Entity to set.
     *
     * @return $this $this
     */
    public function setUsername(string $username): self;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * ToArray function of the property.
     *
     *      Returns array(
     *          'username' => $this->getUsername()
     *      )
     *
     * @return array array
     */
    public function __toArray(): array;

    /*********************************************** STATIC METHODS ***********************************************/

}