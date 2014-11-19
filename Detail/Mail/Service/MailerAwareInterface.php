<?php

namespace Detail\Mail\Service;

interface MailerAwareInterface
{
    /**
     * Set a mailer.
     *
     * @param MailerInterface $mailer
     */
    public function setMailer(MailerInterface $mailer);
}
