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
     * @var MessageFactoryOptions
     */
    protected $messageFactory;

    /**
     * @var array
     */
    protected $listeners = array();

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
    public function setMailers(array $mailers)
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
    public function setDrivers(array $drivers)
    {
        $this->drivers = $drivers;
    }

    /**
     * @return MessageFactoryOptions
     */
    public function getMessageFactory()
    {
        if ($this->messageFactory === null) {
            $this->messageFactory = new MessageFactoryOptions();
        }

        return $this->messageFactory;
    }

    /**
     * @param array $messageFactory
     */
    public function setMessageFactory(array $messageFactory)
    {
        $this->messageFactory = new MessageFactoryOptions($messageFactory);
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
    public function setListeners(array $listeners)
    {
        $this->listeners = $listeners;
    }
}
