<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Interfaces\HasLatitudeInterface;

/**
 * Trait to implement LatitudeTrait property.
 *
 * @see HasLatitudeInterface
 */
trait LatitudeTrait
{

    /************************************************* PROPERTIES *************************************************/

    /**
     * @ORM\Column(type="float")
     */
    protected float $latitude = 0.0;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return int int
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  LatitudeTrait constructor.
     */
    public function __construct(float $latitude = 0.0)
    {
        $this->setLatitude($latitude);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array(
            'latitude' => $this->getLatitude(),
        );
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}