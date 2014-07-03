<?php

namespace Detail\Mail\Factory\Driver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Driver\Bernard\BernardDriver;

class BernardDriverFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return BernardDriver
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Mail\Options\BernardDriverOptions $options */
        $options = $serviceLocator->get('Detail\Mail\Options\BernardDriverOptions');

        /** @var \Detail\Mail\Driver\Bernard\BernardService $bernardService */
        $bernardService = $serviceLocator->get('Detail\Mail\Driver\Bernard\BernardService');

        $driver = new BernardDriver($bernardService);
        $driver->setQueueName($options->getQueueName());

        return $driver;
    }
}
