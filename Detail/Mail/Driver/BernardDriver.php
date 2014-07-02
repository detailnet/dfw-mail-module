<?php

namespace Detail\Mail\Driver;

use Detail\Mail\Message\MessageInterface;

use Bernard\Message as BernardMessage;
use Bernard\Message\DefaultMessage as BernardDefaultMessage;
use Bernard\Producer;

use RuntimeException;

class BernardDriver
    implements DriverInterface
{
    const MESSAGE_CLASS_KEY = 'message_class';
    const MESSAGE_KEY = 'message';

    /**
     * @var Producer
     */
    protected $producer;

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

    public function __construct(Producer $producer, $queueName = null)
    {
        $this->producer = $producer;

        if ($queueName !== null) {
            $this->setQueueName($queueName);
        }
    }

    /**
     * @param MessageInterface $message Message
     */
    public function send(MessageInterface $message)
    {
        // Pushes the message to the "mail" queue
        $this->getProducer()->produce($this->encodeMessage($message));
    }

    /**
     * Encode mail message for Bernard.
     *
     * @param MessageInterface $message
     * @return BernardDefaultMessage
     */
    public function encodeMessage(MessageInterface $message)
    {
        return new BernardDefaultMessage(
            $this->getQueueName(),
            array(
                self::MESSAGE_CLASS_KEY => get_class($message),
                self::MESSAGE_KEY => $message->toArray(),
            )
        );
    }

    /**
     * Decode mail message from Bernard.
     *
     * @param BernardMessage $message
     * @return MessageInterface
     * @throws RuntimeException
     */
    public function decodeMessage(BernardMessage $message)
    {
        if (!isset($message->{self::MESSAGE_CLASS_KEY})) {
            throw new RuntimeException(sprintf('Message is missing key "%s"', self::MESSAGE_CLASS_KEY));
        }

        if (!is_string($message->{self::MESSAGE_CLASS_KEY})) {
            throw new RuntimeException(
                sprintf('Message has invalid value for key "%s"; must be a string', self::MESSAGE_CLASS_KEY)
            );
        }

        if (!isset($message->{self::MESSAGE_KEY})) {
            throw new RuntimeException(sprintf('Message is missing key "%s"', self::MESSAGE_KEY));
        }

        if (!is_array($message->{self::MESSAGE_KEY})) {
            throw new RuntimeException(
                sprintf('Message has invalid value for key "%s"; must be an array', self::MESSAGE_KEY)
            );
        }

        /** @var MessageInterface $messageClass */
        $messageClass = $message->{self::MESSAGE_CLASS_KEY};

        /** @todo Check if class really implements MessageInterface (or fromArray is callable) */

        return $messageClass::fromArray($message->{self::MESSAGE_KEY});
    }

    protected function getProducer()
    {
        return $this->producer;
    }

}
