<?php

namespace Detail\Mail\Factory\Driver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Driver\Bernard\BernardService;

class BernardServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return BernardService
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Mail\Options\BernardDriverOptions $options */
        $options = $serviceLocator->get('Detail\Mail\Options\BernardDriverOptions');

        /** @var \Bernard\Producer $producer */
        $producer = $serviceLocator->get($options->getProducer());

        /** @var \Detail\Mail\Message\MessageFactoryInterface $messageFactory */
        $messageFactory = $serviceLocator->get($options->getMessageFactory());

        $service = new BernardService($producer, $messageFactory);

        return $service;
    }
}
