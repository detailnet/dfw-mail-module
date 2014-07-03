<?php

namespace Detail\Mail\Options;

class BernardDriverOptions extends AbstractOptions
{
    protected $queueName = 'mail';

    protected $producer = 'Bernard\Producer';

    protected $messageFactory = 'Detail\Mail\Message\MessageFactory';

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

    /**
     * @return string
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param string $producer
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;
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
