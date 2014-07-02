<?php

namespace Detail\Mail\Options;

class ModuleOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $defaultMailer = 'Detail\Mail\Service\SimpleMailer';

    /**
     * @var array
     */
    protected $mailers = array();

    /**
     * @var array
     */
    protected $drivers = array();

    /**
     * @return string
     */
    public function getDefaultMailer()
    {
        return $this->defaultMailer;
    }

    /**
     * @param string $defaultMailer
     */
    public function setDefaultMailer($defaultMailer)
    {
        $this->defaultMailer = $defaultMailer;
    }

    /**
     * @return array
     */
    public function getMailers()
    {
        return $this->mailers;
    }

    /**
     * @param array $mailers
     */
    public function setMailers($mailers)
    {
        $this->mailers = $mailers;
    }

    /**
     * @return array
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * @param array $drivers
     */
    public function setDrivers($drivers)
    {
        $this->drivers = $drivers;
    }
}
