<?php

namespace MindTools\TestApp\User;

/**
 * Interface HasherInterface
 *
 * @package MindTools\TestApp\User
 */
interface HasherInterface
{
    /**
     * @param string $password
     *
     * @return string
     */
    public function hash($password);

    /**
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function verify($password, $hash);
}