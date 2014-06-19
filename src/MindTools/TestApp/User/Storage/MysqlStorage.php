<?php

namespace MindTools\TestApp\User\Storage;

use Doctrine\DBAL\Connection;
use MindTools\TestApp\Model\User;

/**
 * Class MysqlStorage
 *
 * @package MindTools\TestApp\User\Storage
 */
class MysqlStorage implements StorageInterface
{
    /** @var \Doctrine\DBAL\Connection */
    protected $dbal;

    /**
     * @param Connection $dbal
     */
    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * @param string $username
     * @param string $name
     * @param string $email
     *
     * @return User
     */
    public function createUser($username, $name, $email)
    {
        $user = $this->makeUser($username, $name, $email);

        return $this->insertUser($user);
    }

    /**
     * @param $username
     *
     * @return bool|User
     */
    public function findUser($username)
    {
        $result = $this->dbal
            ->fetchAssoc("SELECT id, username, name, email, password_hash, status WHERE username = ?", array(
                $username,
            )
        );

        if ($result) {
            return $this->makeUser($result['username'], $result['name'], $result['email'], $result['id']);
        }

        return false;
    }

    /**
     * @param User $user
     */
    public function updateUser(User $user)
    {
        $this->dbal->update('users', array(
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
        ), array(
            'id' => $user->getId(),
        ));
    }

    /**
     * @param $username
     * @param $name
     * @param $email
     * @param null $id
     *
     * @return User
     */
    protected function makeUser($username, $name, $email, $id = null)
    {
        $user = new User();
        $user->setName($name);
        $user->setUsername($username);
        $user->setEmail($email);

        if (null !== $id) {
            $user->setId($id);
        }

        return $user;
    }

    /**
     * @param User $user
     *
     * @return User
     */
    protected function insertUser(User $user)
    {
        $this->dbal->insert('users', array(
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
        ));

        $user->setId($this->dbal->lastInsertId());

        return $user;
    }
}
