<?php

namespace MindTools\TestApp\User\Verification;

use MindTools\TestApp\Email\EmailSender;
use MindTools\TestApp\Model\User;

/**
 * Class EmailVerification
 *
 * @package MindTools\TestApp\User\Verification
 */
class EmailVerification
{
    /**
     * @var \MindTools\TestApp\Email\EmailSender
     */
    protected $mailer;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var string
     */
    protected $siteUrl;

    /**
     * @param EmailSender       $mailer
     * @param \Twig_Environment $twig
     * @param string            $siteUrl
     */
    public function __construct(EmailSender $mailer, \Twig_Environment $twig, $siteUrl)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->siteUrl = $siteUrl;
    }

    /**
     * @param User $user
     *
     * @throws \Exception
     */
    public function sendVerification(User $user)
    {
        if (USER::STATUS_AWAITING_VERIFICATION !== $user->getStatus()) {
            throw new \Exception('Unable to send verification, user status is currently '.$user->getStatus());
        }

        $this->sendEmail($user, $this->makeBody($user));
    }

    /**
     * @param User $user
     *
     * @return string
     */
    protected function makeBody(User $user)
    {
        $body = $this->twig->render('email.html.twig', array(
            'user' => $user,
            'link' => $this->siteUrl.'/verify?code='.$user->getVerificationCode(),
        ));

        return $body;
    }

    /**
     * @param User   $user
     * @param string $body
     */
    protected function sendEmail(User $user, $body)
    {
        $this->mailer->setFrom(array('admin@test.com' => 'Administrator'));
        $this->mailer->setTo(array($user->getEmail() => $user->getName()));
        $this->mailer->setSubject('Account Verification');
        $this->mailer->setBody($body);
        $this->mailer->send();
    }
}
