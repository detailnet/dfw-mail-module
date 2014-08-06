<?php

namespace Detail\Mail\Driver\Bernard;

use Detail\Bernard\Message\Messenger;
use Detail\Mail\Driver\DriverInterface;
use Detail\Mail\Message\MessageInterface;

class BernardDriver
    implements DriverInterface
{
    /**
     * @var Messenger
     */
    protected $messenger;

    /**
     * @var string
     */
    protected $queueName = 'mail';

    /**
     * @return Messenger
     */
    public function getMessenger()
    {
        return $this->messenger;
    }

    /**
     * @param Messenger $messenger
     */
    public function setMessenger(Messenger $messenger)
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

    public function __construct(Messenger $messenger, $queueName = null)
    {
        $this->setMessenger($messenger);

        if ($queueName !== null) {
            $this->setQueueName($queueName);
        }
    }

    /**
     * @param MessageInterface $message Message
     */
    public function send(MessageInterface $message)
    {
        $messenger = $this->getMessenger();
        $bernardMessage = $messenger->encodeMessage($message, $this->getQueueName());
        $messenger->produce($bernardMessage);
    }
}
