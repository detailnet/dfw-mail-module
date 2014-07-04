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
     * @var array
     */
    protected $listeners = array();

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

    /**
     * @return array
     */
    public function getListeners()
    {
        return $this->listeners;
    }

    /**
     * @param array $listeners
     */
    public function setListeners($listeners)
    {
        $this->listeners = $listeners;
    }
}
