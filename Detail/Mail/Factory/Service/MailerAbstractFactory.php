<?php

namespace Detail\Mail\Factory\Service;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Options\MailerOptions;
use Detail\Mail\Service\SimpleMailer;

class MailerAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @var \Detail\Mail\Options\ModuleOptions
     */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $mailers = $this->getOptions($serviceLocator)->getMailers();

        return isset($mailers[$requestedName]);
    }

    /**
     * {@inheritdoc}
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $mailers = $this->getOptions($serviceLocator)->getMailers();
        $options = new MailerOptions($mailers[$requestedName]);

        /** @var \Detail\Mail\Driver\DriverInterface $driver */
        $driver = $serviceLocator->get($options->getDriver());

        /** @var \Detail\Mail\Message\MessageFactoryInterface $messageFactory */
        $messageFactory = $serviceLocator->get($options->getMessageFactory());

        $mailer = new SimpleMailer($driver, $messageFactory);

        return $mailer;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Detail\Mail\Options\ModuleOptions
     */
    public function getOptions(ServiceLocatorInterface $serviceLocator)
    {
        if ($this->options !== null) {
            return $this->options;
        }

        /** @var \Detail\Mail\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Mail\Options\ModuleOptions');

        $this->options = $options;

        return $options;
    }
}
