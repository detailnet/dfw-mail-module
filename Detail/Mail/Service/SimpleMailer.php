<?php

namespace Detail\Mail\Service;

use Detail\Mail\Driver\DriverInterface;
use Detail\Mail\Message\MessageFactoryInterface;
use Detail\Mail\Message\MessageInterface;

class SimpleMailer extends AbstractMailer
{
    /**
     * @var DriverInterface
     */
    protected $driver;

    /**
     * @return DriverInterface
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param DriverInterface $driver
     */
    public function setDriver(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @param string
     * @param MessageFactoryInterface $messageFactory
     * @param DriverInterface $driver
     */
    public function __construct($id, MessageFactoryInterface $messageFactory, DriverInterface $driver)
    {
        parent::__construct($id, $messageFactory);

        $this->setDriver($driver);
    }

    /**
     * @param MessageInterface $message Message
     */
    public function send(MessageInterface $message)
    {
        $this->getEventManager()->trigger(__FUNCTION__ . '.pre', $this, array('message' => $message));
        $this->getDriver()->send($message);
        $this->getEventManager()->trigger(__FUNCTION__ . '.post', $this, array('message' => $message));
    }
}
