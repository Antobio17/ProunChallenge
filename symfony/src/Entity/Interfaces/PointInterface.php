<?php

namespace App\Entity\Interfaces;

use App\Entity\Traits\Interfaces\HasLatitudeInterface;
use App\Entity\Traits\Interfaces\HasLongitudeInterface;
use App\Entity\Traits\Interfaces\HasNameInterface;

/**
 * Point interface.
 */
interface PointInterface extends HasNameInterface, HasLatitudeInterface, HasLongitudeInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Returns the entity in array format.
     *
     *      array(
     *          'name' => string,
     *          'latitude' => float,
     *          'longitude' => float
     *      )
     *
     * @return array array
     */
    public function __toArray(): array;

    /**
     * ToString function of the entity.
     *
     * @return string string
     */
    public function __toString(): string;

    /*********************************************** STATIC METHODS ***********************************************/

}