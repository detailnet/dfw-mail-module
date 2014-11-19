<?php

namespace Detail\Mail\Factory\MtMail;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

use Detail\Mail\MtMail\OverrideHeadersComposerPlugin;

class OverrideHeadersComposerPluginFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if ($serviceLocator instanceof ServiceLocatorAwareInterface) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }

        $config = $serviceLocator->get('Configuration');
        $plugin = new OverrideHeadersComposerPlugin();

        if (isset($config['mt_mail']['override_headers'])) {
            $plugin->setHeaders($config['mt_mail']['override_headers']);
        }

        return $plugin;
    }
}
