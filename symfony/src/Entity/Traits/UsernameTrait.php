<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Traits\Interfaces\HasUsernameInterface;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * Trait to implement Username property.
 *
 * @see HasUsernameInterface
 */
trait UsernameTrait
{

    /************************************************* PROPERTIES *************************************************/

    /**
     * @ORM\Column(type="string", length=1024)
     */
    protected string $username;

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return string string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /************************************************* CONSTRUCT **************************************************/

    /**
     *  UsernameTrait constructor.
     *
     * @param string $username Username of the Entity to set.
     */
    public function __construct(string $username)
    {
        $this->setUsername($username);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array(
            'username' => $this->getUsername()
        );
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}