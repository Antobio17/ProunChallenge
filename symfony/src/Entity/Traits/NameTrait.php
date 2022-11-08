<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Interfaces\HasNameInterface;

/**
 * Trait to implement Name property.
 *
 * @see HasNameInterface
 */
trait NameTrait
{

    /************************************************* PROPERTIES *************************************************/

    /**
     * @ORM\Column(type="string", length=1024)
     */
    protected string $name;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return string string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  NameTrait constructor.
     *
     * @param string $name Name of the Entity to set.
     */
    public function __construct(string $name)
    {
        $this->setName($name);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array(
            'name' => $this->getName()
        );
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}