<?php

namespace App\Service\Interfaces;

use App\Entity\AbstractORM;
use App\Entity\Interfaces\ORMInterface;
use Doctrine\Persistence\ObjectManager;

interface AppServiceInterface
{

    /************************************************** ROUTING ***************************************************/

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the Entity Manager property.
     *
     * @return ObjectManager ObjectManager
     */
    public function getEntityManager(): ObjectManager;

    /**
     * Sets the Entity Manager property.
     *
     * @param ObjectManager $entityManager The entity manager to set.
     *
     * @return $this $this
     */
    public function setEntityManager(ObjectManager $entityManager): self;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Persists an ORM object.
     *
     * @param AbstractORM $object Object to persist in the app.
     *
     * @return bool bool
     */
    public function persistAndFlush(ORMInterface $object): bool;

    /*********************************************** STATIC METHODS ***********************************************/

}