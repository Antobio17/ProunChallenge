<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Interfaces\HasUUIDInterface;
use Symfony\Component\Uid\Uuid;

/**
 * Trait to implement UUID property.
 *
 * @see HasUUIDInterface
 */
trait UUIDTrait
{

    /************************************************* PROPERTIES *************************************************/

    /**
     * @ORM\Column(type="string", length=512, unique=true, nullable=false)
     */
    protected string $uuid;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return string|null string|null
     */
    public function getUUID(): ?string
    {
        return $this->uuid;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  UUIDTrait constructor.
     */
    public function __construct()
    {
        $this->uuid = Uuid::v6()->toRfc4122();
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array(
            'uuid' => $this->getUUID()
        );
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}