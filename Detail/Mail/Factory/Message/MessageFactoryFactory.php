<?php

namespace Detail\Mail\Factory\Message;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Message\MessageFactory;

class MessageFactoryFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return MessageFactory
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Mail\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Mail\Options\ModuleOptions');

        $driver = new MessageFactory();
        $driver->setMessageClass($options->getMessageFactory()->getMessageClass());

        return $driver;
    }
}
