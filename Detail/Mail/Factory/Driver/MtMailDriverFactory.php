<?php

namespace Detail\Mail\Factory\Driver;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Detail\Mail\Driver\MtMailDriver;

class MtMailDriverFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return MtMailDriver
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var \Detail\Mail\Options\MtMailDriverOptions $options */
        $options = $serviceLocator->get('Detail\Mail\Options\MtMailDriverOptions');

        /** @var \MtMail\Service\Mail $mtMail */
        $mtMail = $serviceLocator->get('MtMail\Service\Mail');
        $driver = new MtMailDriver($mtMail);
        $driver->setTemplatePath($options->getTemplatePath());

        return $driver;
    }
}
