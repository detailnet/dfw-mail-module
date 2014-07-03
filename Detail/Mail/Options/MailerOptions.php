<?php

namespace Detail\Mail\Options;

class MailerOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $driver = 'Detail\Mail\Driver\MtMailDriver';

    /**
     * @var string
     */
    protected $messageFactory = 'Detail\Mail\Message\MessageFactory';

    /**
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param string $driver
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return string
     */
    public function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * @param string $messageFactory
     */
    public function setMessageFactory($messageFactory)
    {
        $this->messageFactory = $messageFactory;
    }
}
