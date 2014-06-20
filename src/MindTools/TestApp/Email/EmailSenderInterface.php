<?php

namespace MindTools\TestApp\Email;

/**
 * Interface EmailSenderInterface
 *
 * @package MindTools\TestApp\Email
 */
interface EmailSenderInterface
{
    /**
     * @param $subject
     */
    public function setSubject($subject);

    /**
     * @param array $from
     */
    public function setFrom(array $from);

    /**
     * @param array $to
     */
    public function setTo(array $to);

    /**
     * @param $body
     */
    public function setBody($body);

    /**
     *
     */
    public function send();
}