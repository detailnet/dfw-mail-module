<?php

namespace Detail\Mail\Factory\Service;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use ProxyManager\Proxy\LazyLoadingInterface;

use Detail\Mail\Exception\ConfigException;
use Detail\Mail\Options\MailerOptions;

class MailerAbstractFactory implements AbstractFactoryInterface
{
    /**
     * @var \Detail\Mail\Options\ModuleOptions
     */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $mailers = $this->getOptions($serviceLocator)->getMailers();

        return isset($mailers[$requestedName]);
    }

    /**
     * {@inheritdoc}
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $moduleOptions = $this->getOptions($serviceLocator);

        $mailers = $moduleOptions->getMailers();
        $mailer = new MailerOptions($mailers[$requestedName]);

        $factories = $moduleOptions->getMailerFactories();

        if (!isset($factories[$mailer->getType()])) {
            throw new ConfigException(
                sprintf('No factory configured for mailer type "%s"', $mailer->getType())
            );
        }

        $factoryClass = $factories[$mailer->getType()];
        $factory = $serviceLocator->get($factoryClass);

        if (!$factory instanceof MailerFactoryInterface) {
            throw new ConfigException(
                sprintf(
                    'Invalid factory class "%s" configured for repository type "%s";' .
                    'Expected Detail\Mail\Factory\Service\MailerFactoryInterface object; received "%s"',
                    $factoryClass,
                    $mailer->getType(),
                    (is_object($factory) ? get_class($factory) : gettype($factory))
                )
            );
        }

        if ($mailer->getUseProxy()) {
            /** @var \ProxyManager\Factory\LazyLoadingValueHolderFactory $lazyLoadingFactory */
            $lazyLoadingFactory = $serviceLocator->get('ProxyManager\Factory\LazyLoadingValueHolderFactory');
            $initializer = function (& $wrappedObject, LazyLoadingInterface $proxy, $method, array $parameters, & $initializer) use (
                $factory, $serviceLocator, $requestedName, $mailer
            ) {
                $initializer   = null; // disable initialization
                $wrappedObject = $factory->createMailer($serviceLocator, $requestedName, $mailer->getOptions());

                return true; // confirm that initialization occurred correctly
            };

            return $lazyLoadingFactory->createProxy($factory->getMailerClass(), $initializer);
        } else {
            return $factory->createMailer($serviceLocator, $name, $mailer->getOptions());
        }
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Detail\Mail\Options\ModuleOptions
     */
    public function getOptions(ServiceLocatorInterface $serviceLocator)
    {
        if ($this->options !== null) {
            return $this->options;
        }

        /** @var \Detail\Mail\Options\ModuleOptions $options */
        $options = $serviceLocator->get('Detail\Mail\Options\ModuleOptions');

        $this->options = $options;

        return $options;
    }
}
