<?php

namespace App\Entity;

use App\Entity\Interfaces\PointInterface;
use App\Entity\Interfaces\TripInterface;
use App\Entity\Traits\ServiceLocatorTrait;
use App\Entity\Traits\UUIDTrait;
use App\Entity\Traits\VehicleTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use App\Repository\TripRepository;

/**
 * @ORM\Entity(repositoryClass=TripRepository::class)
 */
class Trip extends AbstractORM implements TripInterface
{

    /************************************************* CONSTANTS **************************************************/

    public const VEHICLE_CAR = 'coche';
    public const VEHICLE_VAN = 'furgoneta';
    public const VEHICLE_POOLING = 'compartido';

    /************************************************* PROPERTIES *************************************************/

    use UUIDTrait {
        UUIDTrait::__construct as protected __UUIDConstruct;
        UUIDTrait::__toArray as protected __UUIDToArray;
    }

    use ServiceLocatorTrait {
        ServiceLocatorTrait::__construct as protected __serviceLocatorConstruct;
        ServiceLocatorTrait::__toArray as protected __serviceLocatorToArray;
    }

    /**
     * @ManyToOne(targetEntity="App\Entity\Point", cascade={"persist"})
     * @JoinColumn(name="collection_point_id", referencedColumnName="id", nullable=false)
     */
    protected PointInterface $collectionPoint;

    /**
     * @ManyToOne(targetEntity="App\Entity\Point", cascade={"persist"})
     * @JoinColumn(name="destination_point_id", referencedColumnName="id", nullable=false)
     */
    protected PointInterface $destinationPoint;

    use VehicleTrait {
        VehicleTrait::__construct as protected __vehicleConstruct;
        VehicleTrait::__toArray as protected __vehicleLocatorToArray;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     * Trip Construct.
     *
     * @param string $serviceLocator The service locator of the trip.
     * @param PointInterface $collectionPoint The collection point of the trip.
     * @param PointInterface $destinationPoint The destination point of the trip.
     * @param string $vehicle The vehicle of the trip.
     */
    public function __construct(string         $serviceLocator, PointInterface $collectionPoint,
                                PointInterface $destinationPoint, string $vehicle)
    {
        $this->__UUIDConstruct();
        $this->__serviceLocatorConstruct($serviceLocator);
        $this->__vehicleConstruct($vehicle);

        $this->setCollectionPoint($collectionPoint)
            ->setDestinationPoint($destinationPoint);
    }

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return PointInterface PointInterface
     */
    public function getCollectionPoint(): PointInterface
    {
        return $this->collectionPoint;
    }

    /**
     * @inheritDoc
     * @return $this $this
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setCollectionPoint(PointInterface $collectionPoint)
    {
        $this->collectionPoint = $collectionPoint;

        return $this;
    }

    /**
     * @inheritDoc
     * @return PointInterface PointInterface
     */
    public function getDestinationPoint(): PointInterface
    {
        return $this->destinationPoint;
    }

    /**
     * @inheritDoc
     * @return $this $this
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function setDestinationPoint(PointInterface $destinationPoint)
    {
        $this->destinationPoint = $destinationPoint;

        return $this;
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array_merge(
            parent::__toArray(),
            $this->__UUIDToArray(),
            $this->__serviceLocatorToArray(),
        );
    }

    /**
     * Returns the entity in a string identifier.
     *
     * @return string string
     */
    public function __toString(): string
    {
        return $this->getUUID();
    }

}