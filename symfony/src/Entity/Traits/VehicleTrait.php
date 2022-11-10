<?php

namespace App\Entity\Traits;

use App\Entity\Trip;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Interfaces\HasVehicleInterface;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * Trait to implement Vehicle property.
 *
 * @see HasVehicleInterface
 */
trait VehicleTrait
{

    /************************************************* PROPERTIES *************************************************/

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected string $vehicle;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return string string
     */
    public function getVehicle(): string
    {
        return $this->vehicle;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setVehicle(string $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  VehicleTrait constructor.
     *
     * @param string $vehicle Vehicle of the Entity to set.
     */
    public function __construct(string $vehicle)
    {
        $this->setVehicle($vehicle);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array(
            'vehicle' => $this->getVehicle()
        );
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return bool bool
     */
    public static function allowVehicle(string $vehicle): bool
    {
        return in_array($vehicle, array(
            Trip::VEHICLE_CAR,
            Trip::VEHICLE_VAN,
            Trip::VEHICLE_POOLING,
        ));
    }

}