<?php

namespace Detail\Mail\Options;

class BernardDriverOptions extends AbstractOptions
{
    protected $queueName = 'mail';

    protected $producer = 'Bernard\Producer';

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
}
