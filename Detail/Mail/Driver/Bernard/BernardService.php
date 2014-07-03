<?php

namespace Detail\Mail\Driver\Bernard;

use Detail\Mail\Message\MessageInterface as MailMessage;
use Detail\Mail\Message\MessageFactoryInterface as MailMessageFactory;

use Bernard\Message as BernardMessage;
use Bernard\Message\DefaultMessage as BernardDefaultMessage;
use Bernard\Producer;

use RuntimeException;

class BernardService
{
    const MESSAGE_CLASS_KEY = 'message_class';
    const MESSAGE_KEY = 'message';

    /**
     * @var Producer
     */
    protected $producer;

    /**
     * @var MailMessageFactory
     */
    protected $messageFactory;

    public function __construct(Producer $producer, MailMessageFactory $messageFactory)
    {
        $this->producer = $producer;
        $this->messageFactory = $messageFactory;
    }

    /**
     * @param BernardMessage $message Message
     */
    public function produce(BernardMessage $message)
    {
        // Pushes the message to the queue
        $this->getProducer()->produce($message);
    }

    /**
     * Encode mail message for Bernard.
     *
     * @param MailMessage $message
     * @param string $queue
     * @return BernardDefaultMessage
     */
    public function encodeMessage(MailMessage $message, $queue)
    {
        return new BernardDefaultMessage(
            $queue,
            array(
                self::MESSAGE_CLASS_KEY => get_class($message),
                self::MESSAGE_KEY => $this->getMessageFactory()->toArray($message),
            )
        );
    }

    /**
     * Decode mail message from Bernard.
     *
     * @param BernardMessage $message
     * @return MailMessage
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

        return $this->getMessageFactory()->createFromArray(
            $message->{self::MESSAGE_KEY},
            $message->{self::MESSAGE_CLASS_KEY}
        );
    }

    protected function getProducer()
    {
        return $this->producer;
    }

    protected function getMessageFactory()
    {
        return $this->messageFactory;
    }
}
