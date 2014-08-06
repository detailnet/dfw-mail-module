<?php

namespace Detail\Mail\Message;

use Detail\Bernard\Message\MessageFactoryInterface as BernardMessageFactoryInterface;
use RuntimeException;

class MessageFactory implements
    MessageFactoryInterface,
    BernardMessageFactoryInterface
{
    protected $messageClass = 'Detail\Mail\Message\Message';

    const KEY_ID = 'id';
    const KEY_NAME = 'name';
    const KEY_HEADERS = 'headers';
    const KEY_VARIABLES = 'variables';

    /**
     * @param string $class
     * @return string
     */
    public function getMessageClass($class = null)
    {
        if (is_string($class)) {
            return $class;
        }

        return $this->messageClass;
    }

    /**
     * @param string $messageClass
     */
    public function setMessageClass($messageClass)
    {
        /** @todo Check if it implements Detail\Mail\Message\MessageInterface */
        $this->messageClass = $messageClass;
    }

    /**
     * {@inheritdoc}
     */
    public function accepts($message)
    {
        return $this->assertMessageType($message, false);
    }

    /**
     * @param $name
     * @param array $headers
     * @param array $variables
     * @param string $messageClass
     * @param string $id
     * @return MessageInterface
     */
    public function createNew($name, array $headers = array(), array $variables = array(), $id = null, $messageClass = null)
    {
        if ($id === null) {
            $id = Id::create();
        }

        /** @todo Assert arguments */
        /** @todo Check if class exists */
        $messageClass = $this->getMessageClass($messageClass);
        $message = new $messageClass($id, $name, $headers, $variables);

        $this->assertMessageType($message);

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public function createFromArray(array $messageData, $messageClass = null)
    {
        $requiredKeys = array(
            self::KEY_NAME,
            self::KEY_HEADERS,
            self::KEY_VARIABLES,
        );

        foreach ($requiredKeys as $key) {
            if (!isset($messageData[$key])
                || (is_string($messageData[$key]) && strlen($messageData[$key]) === 0)
            ) {
                throw new RuntimeException(
                    sprintf('Invalid or no value for message key "%s"', $key)
                );
            }
        }

        return $this->createNew(
            $messageData[self::KEY_NAME],
            $messageData[self::KEY_HEADERS],
            $messageData[self::KEY_VARIABLES],
            isset($messageData[self::KEY_ID]) ? $messageData[self::KEY_ID] : null,
            $messageClass
        );
    }

    /**
     * {@inheritdoc}
     */
    public function toArray($message)
    {
        $this->assertMessageType($message);

        return array(
            self::KEY_ID        => (string) $message->getId(),
            self::KEY_NAME      => $message->getName(),
            self::KEY_HEADERS   => $message->getHeaders(),
            self::KEY_VARIABLES => $message->getVariables(),
        );
    }

    /**
     * @param MessageInterface $message
     * @param bool $failOnMismatch
     * @return bool
     * @throws RuntimeException
     */
    protected function assertMessageType($message, $failOnMismatch = true)
    {
        if (!$message instanceof MessageInterface) {
            if ($failOnMismatch !== false) {
                throw new RuntimeException(
                    sprintf(
                        '%s only accepts message objects of type' .
                        'Detail\Bernard\Message\MessageInterface; received "%s"',
                        get_class($this),
                        (is_object($message) ? get_class($message) : gettype($message))
                    )
                );
            } else {
                return false;
            }
        }

        return true;
    }
}
