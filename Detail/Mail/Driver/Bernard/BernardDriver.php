<?php

namespace Detail\Mail\Driver\Bernard;

use Detail\Mail\Driver\DriverInterface;
use Detail\Mail\Message\MessageInterface;

class BernardDriver
    implements DriverInterface
{
    /**
     * @var BernardService
     */
    protected $bernardService;

    protected $queueName = 'mail';

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

    public function __construct(BernardService $bernardService, $queueName = null)
    {
        $this->bernardService = $bernardService;

        if ($queueName !== null) {
            $this->setQueueName($queueName);
        }
    }

    /**
     * @param MessageInterface $message Message
     */
    public function send(MessageInterface $message)
    {
        $bernardService = $this->getBernardService();
        $bernardMessage = $bernardService->encodeMessage($message, $this->getQueueName());
        $bernardService->produce($bernardMessage);
    }

    protected function getBernardService()
    {
        return $this->bernardService;
    }
}
