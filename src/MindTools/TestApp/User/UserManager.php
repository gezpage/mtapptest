<?php

namespace MindTools\TestApp\User;

use MindTools\TestApp\User\Storage\StorageInterface;
use MindTools\TestApp\Model\User;

/**
 * Class UserManager
 *
 * @package MindTools\TestApp\User
 */
class UserManager
{
    /** @var Storage\StorageInterface */
    protected $storage;

    /**
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param string $username
     * @param string $name
     * @param string $email
     * @param string $password
     *
     * @return User
     */
    public function createUser($username, $name, $email, $password)
    {
        return $this->storage->createUser($username, $name, $email, $password);
    }
}
