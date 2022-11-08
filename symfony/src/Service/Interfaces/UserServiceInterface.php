<?php

namespace App\Service\Interfaces;


use App\Repository\Interfaces\UserRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

interface UserServiceInterface extends AppServiceInterface
{

    /******************************************** GETTERS AND SETTERS *********************************************/

    /**
     * Gets the UserPasswordHasher to encode the user password.
     *
     * @return UserPasswordHasherInterface UserPasswordHasherInterface
     */
    public function getUserPasswordHasher(): UserPasswordHasherInterface;

    /**
     * Sets the UserPasswordHasher to encode the user password.
     *
     * @param UserPasswordHasherInterface $userPasswordHasher Hasher to encode the user password.
     *
     * @return $this $this
     */
    public function setUserPasswordHasher(UserPasswordHasherInterface $userPasswordHasher): self;

    /**
     * Gets the AuthenticationSuccessHandler to return a response with the user's token.
     *
     * @return AuthenticationSuccessHandler AuthenticationSuccessHandler
     */
    public function getAuthenticationSuccessHandler(): AuthenticationSuccessHandler;

    /**
     * Sets the AuthenticationSuccessHandler to return a response with the user's token.
     *
     * @param AuthenticationSuccessHandler $authenticationSuccessHandler Handler to return a response with user's token.
     *
     * @return $this $this
     */
    public function setAuthenticationSuccessHandler(AuthenticationSuccessHandler $authenticationSuccessHandler): self;

    /**
     * Gets the PasswordHasherFactoryInterface to check the user logging.
     *
     * @return PasswordHasherFactoryInterface PasswordHasherFactoryInterface
     */
    public function getPasswordHasherFactoryInterface(): PasswordHasherFactoryInterface;

    /**
     * Sets the PasswordHasherFactoryInterface to check the user logging.
     *
     * @param PasswordHasherFactoryInterface $passwordHasherFactory Factory of PasswordHasher.
     *
     * @return $this $this
     */
    public function setPasswordHasherFactoryInterface(PasswordHasherFactoryInterface $passwordHasherFactory): self;

    /**
     * Facade that returns an instance of the UserRepository.
     *
     * @return UserRepositoryInterface UserRepositoryInterface
     */
    public function getUserRepository(): UserRepositoryInterface;

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Registers a new user in the application.
     *
     * @param string $username The username of the new user.
     * @param string $password The password of the new user.
     *
     * @return bool bool
     */
    public function signup(string $username, string $password): bool;

    /**
     * Checks if the logging of the user is correct.
     *
     *      return (
     *          'token' => 'the token'
     *      )
     *
     * @param string $username The username of the new user.
     * @param string $password The password of the new user.
     *
     * @return array|null array|null
     */
    public function signin(string $username, string $password): ?array;

    /*********************************************** STATIC METHODS ***********************************************/

}