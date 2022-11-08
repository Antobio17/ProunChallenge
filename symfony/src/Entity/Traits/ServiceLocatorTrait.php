<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Interfaces\HasServiceLocatorInterface;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * Trait to implement ServiceLocator property.
 *
 * @see HasServiceLocatorInterface
 */
trait ServiceLocatorTrait
{

    /************************************************* PROPERTIES *************************************************/

    /**
     * @ORM\Column(type="string", length=1024)
     */
    protected string $serviceLocator;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return string string
     */
    public function getServiceLocator(): string
    {
        return $this->serviceLocator;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setServiceLocator(string $serviceLocator): self
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  ServiceLocatorTrait constructor.
     *
     * @param string $serviceLocator ServiceLocator of the Entity to set.
     */
    public function __construct(string $serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array(
            'serviceLocator' => $this->getServiceLocator()
        );
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}