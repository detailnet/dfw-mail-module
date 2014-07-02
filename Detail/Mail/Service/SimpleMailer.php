<?php

namespace Detail\Mail\Service;

use Detail\Mail\Driver\DriverInterface;
use Detail\Mail\Message\MessageInterface;

class SimpleMailer extends AbstractMailer
{
    /**
     * @var DriverInterface
     */
    protected $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->setDriver($driver);
    }

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
     * @param MessageInterface $message Message
     */
    public function send(MessageInterface $message)
    {
        $this->getDriver()->send($message);
    }
}
