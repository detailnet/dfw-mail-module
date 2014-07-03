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
     * @param DriverInterface $driver
     * @param MessageFactoryInterface $messageFactory
     */
    public function __construct(DriverInterface $driver, MessageFactoryInterface $messageFactory)
    {
        parent::__construct($messageFactory);

        $this->setDriver($driver);
    }

    /**
     * @param MessageInterface $message Message
     */
    public function send(MessageInterface $message)
    {
        $this->getDriver()->send($message);
    }
}
