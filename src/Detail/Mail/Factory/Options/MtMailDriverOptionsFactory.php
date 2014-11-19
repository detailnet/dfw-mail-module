<?php

namespace Detail\Mail\Factory\Options;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Options\MtMailDriverOptions;

use RuntimeException;

class MtMailDriverOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return MtMailDriverOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Mail\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Mail\Options\ModuleOptions');
        $drivers = $options->getDrivers();

        if (!isset($drivers['mt_mail'])) {
            throw new RuntimeException('Config for driver Detail\Mail\Driver\MtMailDriver is not set');
        }

        return new MtMailDriverOptions($drivers['mt_mail']);
    }
}
