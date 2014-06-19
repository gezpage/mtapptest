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
     */
    public function createUser($username, $name, $email);

    public function findUser($username);

    public function updateUser(User $user);
}