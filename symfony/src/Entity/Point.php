<?php

namespace App\Entity;

use App\Entity\Interfaces\PointInterface;
use App\Entity\Traits\LatitudeTrait;
use App\Entity\Traits\LongitudeTrait;
use App\Entity\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PointRepository;

/**
 * @ORM\Entity(repositoryClass=PointRepository::class)
 */
class Point extends AbstractORM implements PointInterface
{

    /************************************************* CONSTANTS **************************************************/

    /************************************************* PROPERTIES *************************************************/

    use NameTrait {
        NameTrait::__construct as protected __nameConstruct;
        NameTrait::__toArray as protected __nameToArray;
    }

    use LatitudeTrait {
        LatitudeTrait::__construct as protected __latitudeConstruct;
        LatitudeTrait::__toArray as protected __latitudeToArray;
    }

    use LongitudeTrait {
        LongitudeTrait::__construct as protected __longitudeConstruct;
        LongitudeTrait::__toArray as protected __longitudeToArray;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     * Point Construct.
     *
     * @param string $name The name of the point.
     * @param float $latitude The latitude of the point.
     * @param float $longitude The longitude of the point.
     */
    public function __construct(string $name, float $latitude, float $longitude)
    {
        $this->__nameConstruct($name);
        $this->__latitudeConstruct($latitude);
        $this->__longitudeConstruct($longitude);
    }

    /******************************************** GETTERS AND SETTERS *********************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array_merge(
            parent::__toArray(),
            $this->__nameToArray(),
            $this->__latitudeToArray(),
            $this->__longitudeToArray(),
        );
    }

    /**
     * Returns the entity in a string identifier.
     *
     * @return string string
     */
    public function __toString(): string
    {
        return $this->getName();
    }

}