<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

/**
 * Class MailerMessage.
 */
class MailerMessage
{
    /**
     * A MailerInterface Injection
     *
     * @var MailerInterface
     */
    private $mailer;

    /**
     * MailerMessage constructor.
     *
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Send email to user with a link to activate new account
     *
     * @param string $recipient
     * @param string $username
     * @param string $url
     *
     * @return void
     *
     * @throws TransportExceptionInterface
     */
    public function sendSignUpEmail(string $recipient, string $username, string $url): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('wizbhoo.dev@gmail.com', 'SnowTricks - APi'))
            ->to(new Address($recipient))
            ->subject('Activation de votre compte SnowTricks')
            ->htmlTemplate('emails/signup.html.twig')
            ->textTemplate('emails/signup.txt.twig')
            ->context(
                [
                    'expiration_date' => new \DateTime('+1 days'),
                    'username' => $username,
                    'url' => $url,
                ]
            )
        ;

        $this->mailer->send($email);
    }

    /**
     * Send email to user with a link to reset his password.
     *
     * @param string $recipient
     * @param string $username
     * @param string $url
     *
     * @return void
     *
     * @throws TransportExceptionInterface
     */
    public function sendPasswordEmail(string $recipient, string $username, string $url): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('wizbhoo.dev@gmail.com', 'SnowTricks - APi'))
            ->to(new Address($recipient))
            ->subject('Réinitialisation de votre mot de passe')
            ->htmlTemplate('emails/password.html.twig')
            ->textTemplate('emails/password.txt.twig')
            ->context(
                [
                    'expiration_date' => new \DateTime('+10 minutes'),
                    'username' => $username,
                    'url' => $url,
                ]
            )
        ;

        $this->mailer->send($email);
    }
}
