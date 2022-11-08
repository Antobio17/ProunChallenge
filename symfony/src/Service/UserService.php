<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\UserRepository;
use App\Service\Interfaces\UserServiceInterface;
use Doctrine\Persistence\ManagerRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService extends AppService implements UserServiceInterface
{

    /************************************************* CONSTANTS **************************************************/

    /************************************************* PROPERTIES *************************************************/

    /**
     * @var UserPasswordHasherInterface
     */
    protected UserPasswordHasherInterface $userPasswordHasher;

    /**
     * @var AuthenticationSuccessHandler
     */
    protected AuthenticationSuccessHandler $authenticationSuccessHandler;

    /**
     * @var PasswordHasherFactoryInterface
     */
    protected PasswordHasherFactoryInterface $passwordHasherFactory;

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /************************************************* CONSTRUCT **************************************************/

    /**
     * UserService construct.
     *
     * @param ManagerRegistry $doctrine Doctrine to manage the ORM.
     * @param UserPasswordHasherInterface $userPasswordHasher Hasher to encode the user password.
     * @param AuthenticationSuccessHandler $authenticationSuccessHandler Handler to return a response with user's token.
     * @param PasswordHasherFactoryInterface $passwordHasherFactory The Factory PasswordHasher.
     */
    public function __construct(ManagerRegistry                $doctrine,
                                UserPasswordHasherInterface    $userPasswordHasher,
                                AuthenticationSuccessHandler   $authenticationSuccessHandler,
                                PasswordHasherFactoryInterface $passwordHasherFactory)
    {
        parent::__construct($doctrine);

        $this->setUserPasswordHasher($userPasswordHasher)
            ->setAuthenticationSuccessHandler($authenticationSuccessHandler)
            ->setPasswordHasherFactoryInterface($passwordHasherFactory);
    }

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * @inheritDoc
     * @return UserPasswordHasherInterface UserPasswordHasherInterface
     */
    public function getUserPasswordHasher(): UserPasswordHasherInterface
    {
        return $this->userPasswordHasher;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setUserPasswordHasher(UserPasswordHasherInterface $userPasswordHasher): self
    {
        $this->userPasswordHasher = $userPasswordHasher;

        return $this;
    }

    /**
     * @inheritDoc
     * @return AuthenticationSuccessHandler AuthenticationSuccessHandler
     */
    public function getAuthenticationSuccessHandler(): AuthenticationSuccessHandler
    {
        return $this->authenticationSuccessHandler;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setAuthenticationSuccessHandler(AuthenticationSuccessHandler $authenticationSuccessHandler): self
    {
        $this->authenticationSuccessHandler = $authenticationSuccessHandler;

        return $this;
    }

    /**
     * @inheritDoc
     * @return PasswordHasherFactoryInterface PasswordHasherFactoryInterface
     */
    public function getPasswordHasherFactoryInterface(): PasswordHasherFactoryInterface
    {
        return $this->passwordHasherFactory;
    }

    /**
     * @inheritDoc
     * @return $this $this
     */
    public function setPasswordHasherFactoryInterface(PasswordHasherFactoryInterface $passwordHasherFactory): self
    {
        $this->passwordHasherFactory = $passwordHasherFactory;

        return $this;
    }

    /**
     * @inheritDoc
     * @return UserRepositoryInterface UserRepositoryInterface
     */
    public function getUserRepository(): UserRepositoryInterface
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getEntityManager()->getRepository(User::class);
    }

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * @inheritDoc
     * @return bool bool
     */
    public function signup(string $username, string $password): bool
    {
        $user = $this->getUserRepository()->findByUsername($username);

        if ($user === NULL):
            $user = new User($username, $password);
            $encodedPassword = $this->getUserPasswordHasher()->hashPassword($user, $password);
            $user->setPassword($encodedPassword);
            $persisted = $this->persistAndFlush($user);
        endif;

        return $persisted ?? FALSE;
    }

    /**
     * @inheritDoc
     * @return array array
     */
    public function signin(string $username, string $password): ?array
    {
        $token = NULL;
        $user = $this->getUserRepository()->findByUsername($username);

        if (
            $user !== NULL &&
            $this->passwordHasherFactory->getPasswordHasher($user)->verify($user->getPassword(), $password)
        ):
            $JSONToken = $this->getAuthenticationSuccessHandler()->handleAuthenticationSuccess($user)->getContent();
            $token = json_decode($JSONToken, TRUE);
        endif;

        return $token;
    }

    /********************************************** PROTECTED METHODS *********************************************/

    /*********************************************** STATIC METHODS ***********************************************/

}