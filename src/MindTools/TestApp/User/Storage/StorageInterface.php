<?php

namespace MindTools\TestApp\User\Storage;

use MindTools\TestApp\Model\User;

/**
 * Class StorageInterface
 * 
 * @package MindTools\TestApp\User\Storage
 */
interface StorageInterface
{
    /**
     * @param string $username
     * @param string $name
     * @param string $email
     * @param string $passwordHash
     */
    public function createUser($username, $name, $email, $passwordHash);

    /**
     * @param $username
     *
     * @return User
     */
    public function findUser($username);

    /**
     * @param $code
     *
     * @return User
     */
    public function findUserByVerificationCode($code);

    /**
     * @param User $user
     */
    public function updateUser(User $user);
}