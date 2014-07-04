<?php

namespace Detail\Mail\Service;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class MailerInitializer implements InitializerInterface
{
    /**
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return null
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof MailerAwareInterface) {
            if ($serviceLocator instanceof ServiceLocatorAwareInterface) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }

            /** @var \Detail\Mail\Options\ModuleOptions $options */
            $options = $serviceLocator->get('Detail\Mail\Options\ModuleOptions');

            /** @var MailerInterface $mailer */
            $mailer = $serviceLocator->get($options->getDefaultMailer());
            $instance->setMailer($mailer);
        }
    }
}
