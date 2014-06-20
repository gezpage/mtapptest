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
     * @param string $passwordHash
     *
     * @return User
     */
    public function createUser($username, $name, $email, $passwordHash)
    {
        $user = $this->makeUser($username, $name, $email, $passwordHash, User::STATUS_AWAITING_VERIFICATION);
        $user->setVerificationCode(md5(uniqid(rand(), true)));

        return $this->insertUser($user);
    }

    /**
     * @param string $username
     *
     * @return bool|User
     */
    public function findUser($username)
    {
        $result = $this->dbal
            ->fetchAssoc("SELECT id, username, name, email, password_hash, status FROM users WHERE username = ?", array(
                $username,
            )
        );

        if ($result) {
            return $this->makeUser($result['username'], $result['name'], $result['email'], $result['password_hash'], $result['status'], $result['id']);
        }

        return false;
    }

    /**
     * @param string $code
     *
     * @return bool|User
     */
    public function findUserByVerificationCode($code)
    {
        $result = $this->dbal
            ->fetchAssoc("SELECT id, username, name, email, password_hash, status FROM users WHERE verification_code = ?", array(
                    $code,
                )
            );

        if ($result) {
            return $this->makeUser($result['username'], $result['name'], $result['email'], $result['password_hash'], $result['status'], $result['id']);
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
            'status' => $user->getStatus(),
        ), array(
            'id' => $user->getId(),
        ));
    }

    /**
     * @param $username
     * @param $name
     * @param $email
     * @param $passwordHash
     * @param $status
     * @param null $id
     *
     * @return User
     */
    protected function makeUser($username, $name, $email, $passwordHash, $status, $id = null)
    {
        $user = new User();
        $user->setName($name);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPasswordHash($passwordHash);
        $user->setStatus($status);

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
            'password_hash' => $user->getPasswordHash(),
            'verification_code' => $user->getVerificationCode(),
        ));

        $user->setId($this->dbal->lastInsertId());

        return $user;
    }
}
