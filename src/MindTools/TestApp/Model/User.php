<?php

namespace MindTools\TestApp\Model;

/**
 * Class User
 *
 * @package MindTools\TestApp\Model
 */
class User
{
    /** @const string */
    const STATUS_AWAITING_VERIFICATION = 'awaiting_verification';

    /** @const string */
    const STATUS_ENABLED = 'enabled';

    /** @const string */
    const STATUS_DISABLED = 'disabled';

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /** @var string */
    private $passwordHash;

    /** @var string */
    private $status;

    /** @var string */
    private $verificationCode = null;

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $passwordHash
     */
    public function setPasswordHash($passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return string
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $verificationCode
     */
    public function setVerificationCode($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    /**
     * @return string
     */
    public function getVerificationCode()
    {
        return $this->verificationCode;
    }
}
