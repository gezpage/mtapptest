<?php

namespace MindTools\TestApp\User\Storage;

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
     * @param string $password
     */
    public function createUser($username, $name, $email, $password);
}