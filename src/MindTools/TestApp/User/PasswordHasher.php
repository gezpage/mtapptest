<?php

namespace MindTools\TestApp\User;

class PasswordHasher implements HasherInterface
{
    /**
     * @param string $password
     *
     * @return string
     */
    public function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
