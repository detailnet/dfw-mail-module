<?php

namespace Detail\Mail\Factory\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Exception\ConfigException;
use Detail\Mail\Service\SimpleMailer as Mailer;
use Detail\Mail\Options\SimpleMailerOptions as Options;

class SimpleMailerFactory implements
    MailerFactoryInterface
{
    /**
     * @var string
     */
    protected $mailerClass = 'Detail\Mail\Service\SimpleMailer';

    /**
     * {@inheritdoc}
     */
    public function getMailerClass()
    {
        return $this->mailerClass;
    }

    /**
     * {@inheritdoc}
     */
    public function createMailer(ServiceLocatorInterface $serviceLocator, $id, array $config)
    {
        $mailerOptions = new Options($config);
        $mailerClass = $this->getMailerClass();

        if (!class_exists($mailerClass)) {
            throw new ConfigException(
                sprintf(
                    'Invalid mailer class "%s" specified in "class"; ' .
                    'must be a valid class name',
                    $mailerClass
                )
            );
        }

        /** @var \Detail\Mail\Driver\DriverInterface $driver */
        $driver = $serviceLocator->get($mailerOptions->getDriver());

        /** @var \Detail\Mail\Message\MessageFactoryInterface $messageFactory */
        $messageFactory = $serviceLocator->get($mailerOptions->getMessageFactory());

        $mailer = new Mailer($id, $messageFactory, $driver);

        // We're injecting the event manager by ourselves, since the mailer does not implement
        // EventManagerAwareInterface anymore (it would break lazy loading when the event manager
        // would be injected through Zend's initializer (se Zend\Mvc\Service\ServiceManagerConfig).
        /** @todo Find way to implement EventManagerAwareInterface */
        /** @var \Zend\EventManager\EventManagerInterface $eventManager */
        $eventManager = $serviceLocator->get('EventManager');
        $mailer->setEventManager($eventManager);

        foreach ($mailerOptions->getListeners() as $listenerId) {
            /** @var \Detail\Mail\Listener\ListenerInterface $listener */
            $listener = $serviceLocator->get($listenerId); // Fetches new instance each time (not shared)
            $listener->setMailerId($id);
            $listener->attach($mailer->getEventManager());
        }

        return $mailer;
    }
}
