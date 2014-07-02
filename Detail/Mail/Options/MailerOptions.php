<?php

namespace Detail\Mail\Options;

class MailerOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $driver = 'Detail\Mail\Driver\MtMailDriver';

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
}
