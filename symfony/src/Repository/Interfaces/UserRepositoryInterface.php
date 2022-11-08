<?php

namespace App\Repository\Interfaces;

use App\Entity\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface UserRepositoryInterface extends PasswordUpgraderInterface
{

    /*********************************************** PUBLIC METHODS ***********************************************/

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void;

    /**
     * Finds a User searching by the email passed.
     *
     * @param string $username Username for search.
     *
     * @return User|null User|null
     */
    public function findByUsername(string $username): ?UserInterface;

}