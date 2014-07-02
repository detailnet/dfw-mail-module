<?php

namespace Detail\Mail\Factory\Driver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Driver\BernardDriver;

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

        /** @var \Bernard\Producer $producer */
        $producer = $serviceLocator->get($options->getProducer());

        $driver = new BernardDriver($producer);
        $driver->setQueueName($options->getQueueName());

        return $driver;
    }
}
