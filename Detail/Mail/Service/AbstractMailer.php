<?php

namespace Detail\Mail\Service;

use Detail\Mail\Message\MessageFactoryInterface;
use Detail\Mail\Message\MessageInterface;

abstract class AbstractMailer implements
    MailerInterface
{
    /**
     * @var MessageFactoryInterface
     */
    protected $messageFactory;

    /**
     * @return MessageFactoryInterface
     */
    public function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * @param MessageFactoryInterface $messageFactory
     */
    public function setMessageFactory($messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }

    /**
     * @param MessageFactoryInterface $messageFactory
     */
    public function __construct(MessageFactoryInterface $messageFactory)
    {
        $this->setMessageFactory($messageFactory);
    }

    /**
     * @param string $name
     * @param array $headers Message headers
     * @param array $variables
     * @return MessageInterface
     */
    public function compose($name, array $headers = array(), array $variables = array())
    {
        return $this->getMessageFactory()->createNew($name, $headers, $variables);
    }
}
