<?php

namespace Detail\Mail\Options;

use Detail\Core\Options\AbstractOptions;

class BernardDriverOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $messenger;

    /**
     * @var string
     */
    protected $queueName = 'mail';

    /**
     * @return string
     */
    public function getMessenger()
    {
        return $this->messenger;
    }

    /**
     * @param string $messenger
     */
    public function setMessenger($messenger)
    {
        $this->messenger = $messenger;
    }

    /**
     * @return string
     */
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @param string $queueName
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;
    }
}
