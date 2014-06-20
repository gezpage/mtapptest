<?php

namespace MindTools\TestApp\Email;

/**
 * Class EmailSender
 *
 * @package MindTools\TestApp\Email
 */
class EmailSender
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var array
     */
    protected $from = array();

    /**
     * @var array
     */
    protected $to = array();

    /**
     * @var string
     */
    protected $body;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @param array $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param array $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * Send the email
     */
    public function send()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->subject)
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setBody($this->body, 'text/html');

        $this->mailer->send($message);
    }
}
