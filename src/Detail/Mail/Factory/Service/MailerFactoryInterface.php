<?php

namespace Detail\Mail\Factory\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

interface MailerFactoryInterface
{
    /**
     * Create mailer.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param string $id Mailer ID
     * @param array $config
     * @return \Detail\Mail\Service\MailerInterface
     */
    public function createMailer(ServiceLocatorInterface $serviceLocator, $id, array $config);

    /**
     * Get repository class name.
     *
     * @return string
     */
    public function getMailerClass();
}
