<?php

namespace App\Entity;

use App\Entity\Traits\Interfaces\HasPasswordInterface;
use App\Entity\Traits\Interfaces\HasUsernameInterface;
use App\Entity\Traits\PasswordTrait;
use App\Entity\Traits\UsernameTrait;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User extends AbstractORM implements UserInterface, PasswordAuthenticatedUserInterface,
    HasUsernameInterface, HasPasswordInterface
{

    /************************************************* CONSTANTS **************************************************/

    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';

    /************************************************* PROPERTIES *************************************************/

    use UsernameTrait {
        UsernameTrait::__construct as protected __usernameConstruct;
        UsernameTrait::__toArray as protected __usernameToArray;
    }

    use PasswordTrait {
        PasswordTrait::__construct as protected __passwordConstruct;
        PasswordTrait::__toArray as protected __passwordToArray;
    }

    /**
     * @ORM\Column(type="json")
     */
    protected array $roles = array();

    /************************************************* CONSTRUCT **************************************************/

    /**
     * User Construct.
     *
     * @param string $username The username of the user.
     * @param string $password The password of the user.
     * @param array $roles The roles of the user.
     */
    public function __construct(string $username, string $password, array $roles = array())
    {
        $this->__usernameConstruct($username);
        $this->__passwordConstruct($password);

        $this->setRoles(empty($roles) ? array(static::ROLE_USER) : $roles);
    }

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        # Guarantee every user at least has ROLE_USER
        $roles[] = static::ROLE_USER;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * A visual identifier that represents this user.
     *
     * @return  string string
     */
    #[Pure] public function getUserIdentifier(): string
    {
        return $this->getUsername();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        # If you store any temporary, sensitive data on the user, clear it here
        # $this->plainPassword = null;
    }

    /**
     * @inheritDoc
     * @return array array
     */
    public function __toArray(): array
    {
        return array_merge(
            parent::__toArray(),
            $this->__usernameToArray(),
            $this->__passwordToArray(),
            array(
                'roles' => $this->getRoles(),
            )
        );
    }

    /**
     * Returns the entity in a string identifier.
     *
     * @return string string
     */
    public function __toString(): string
    {
        return $this->getUsername();
    }

}