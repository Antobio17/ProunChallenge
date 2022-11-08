<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Interfaces\HasLongitudeInterface;

/**
 * Trait to implement LongitudeTrait property.
 *
 * @see HasLongitudeInterface
 */
trait LongitudeTrait
{

    /************************************************* PROPERTIES *************************************************/

    /**
     * @ORM\Column(type="float")
     */
    protected float $longitude = 0.0;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return int int
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  LongitudeTrait constructor.
     */
    public function __construct(float $longitude = 0.0)
    {
        $this->setLongitude($longitude);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array(
            'longitude' => $this->getLongitude(),
        );
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}