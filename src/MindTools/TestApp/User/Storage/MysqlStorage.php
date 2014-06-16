<?php

namespace MindTools\TestApp\User\Storage;

use MindTools\TestApp\Model\User;

/**
 * Class MysqlStorage
 *
 * @package MindTools\TestApp\User\Storage
 */
class MysqlStorage implements StorageInterface
{
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
        $user = new User();
        $user->setName($name);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);

        return $user;
    }
}
