<?php

namespace Detail\Mail\Service;

use RuntimeException;

trait MailerAwareTrait
{
    /**
     * @var MailerInterface
     */
    protected $mailer;

    /**
     * Set a mailer.
     *
     * @param MailerInterface $mailer
     */
    public function setMailer(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param string $name
     * @param array $headers Message headers
     * @param array $variables
     * @throws RuntimeException
     */
    protected function sendMail($name, array $headers, array $variables = array())
    {
        if ($this->mailer === null) {
            throw new RuntimeException('Failed to send email; no mailer was initialized');
        }

        $message = $this->mailer->compose($name, $headers, $variables);

        $this->mailer->send($message);
    }
}
