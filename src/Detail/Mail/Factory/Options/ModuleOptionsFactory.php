<?php

namespace Detail\Mail\Factory\Options;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Options\ModuleOptions;

use RuntimeException;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (!isset($config['detail_mail'])) {
            throw new RuntimeException('Config for Detail\Mail is not set');
        }

        return new ModuleOptions($config['detail_mail']);
    }
}
