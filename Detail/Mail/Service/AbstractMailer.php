<?php

namespace Detail\Mail\Service;

use Detail\Mail\Message\MessageFactoryInterface;
use Detail\Mail\Message\MessageInterface;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

abstract class AbstractMailer implements
    MailerInterface
//    EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var MessageFactoryInterface
     */
    protected $messageFactory;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @param string $id
     * @param MessageFactoryInterface $messageFactory
     */
    public function __construct($id, MessageFactoryInterface $messageFactory)
    {
        $this->id = $id;
        $this->eventIdentifier = $id;
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
