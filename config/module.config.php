<?php

return array(
    'service_manager' => array(
        'abstract_factories' => array(
            'Detail\Mail\Factory\Service\MailerAbstractFactory',
        ),
        'aliases' => array(
        ),
        'invokables' => array(
            'Detail\Mail\Listener\LoggingListener'            => 'Detail\Mail\Listener\LoggingListener',
            'Detail\Mail\Factory\Service\SimpleMailerFactory' => 'Detail\Mail\Factory\Service\SimpleMailerFactory',
        ),
        'factories' => array(
            'Detail\Mail\Driver\Bernard\BernardService' => 'Detail\Mail\Factory\Driver\BernardServiceFactory',
            'Detail\Mail\Driver\Bernard\BernardDriver'  => 'Detail\Mail\Factory\Driver\BernardDriverFactory',
            'Detail\Mail\Driver\MtMail\MtMailDriver'    => 'Detail\Mail\Factory\Driver\MtMailDriverFactory',
            'Detail\Mail\Message\MessageFactory'        => 'Detail\Mail\Factory\Message\MessageFactoryFactory',
            'Detail\Mail\Options\ModuleOptions'         => 'Detail\Mail\Factory\Options\ModuleOptionsFactory',
            'Detail\Mail\Options\BernardDriverOptions'  => 'Detail\Mail\Factory\Options\BernardDriverOptionsFactory',
            'Detail\Mail\Options\MtMailDriverOptions'   => 'Detail\Mail\Factory\Options\MtMailDriverOptionsFactory',
        ),
        'initializers' => array(
            'Detail\Mail\Service\MailerInitializer',
        ),
        'shared' => array(
            'Detail\Mail\Listener\LoggingListener' => false,
        ),
    ),
    'controllers' => array(
        'initializers' => array(
            'Detail\Mail\Service\MailerInitializer',
        ),
    ),
    'detail_mail' => array(
        'default_mailer' => null,
        'mailers' => array(),
        'drivers' => array(
            'bernard' => array(
                'queue_name' => 'mail',
                'messenger' => 'bernard.messenger.detail_mail',
            ),
            'mt_mail' => array(
                'template_path' => 'mail',
            ),
        ),
        'mailer_factories' => array(
            'simple' => 'Detail\Mail\Factory\Service\SimpleMailerFactory',
        ),
        'message_factory' => array(
            'message_class' => 'Detail\Mail\Message\Message',
        ),
        // Default options for the listeners; currently not used
        'listeners' => array(
            'logging' => array(),
        ),
    ),
    'bernard' => array(
        'messengers' => array(
            'bernard.messenger.detail_mail' => array(
                'message_factory' => 'Detail\Mail\Message\MessageFactory',
                'producer' => 'Bernard\Producer',
            ),
        ),
    ),
);
