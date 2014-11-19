<?php

namespace Detail\Mail\Factory\MtMail;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
        $config = $serviceLocator->getServiceLocator()->get('Configuration');
        $plugin = new OverrideHeadersComposerPlugin();

        if (isset($config['mt_mail']['override_headers'])) {
            $plugin->setHeaders($config['mt_mail']['override_headers']);
        }

        return $plugin;
    }
}
