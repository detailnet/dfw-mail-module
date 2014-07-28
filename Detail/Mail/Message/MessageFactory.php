<?php

namespace Detail\Mail\Message;

class MessageFactory
    implements MessageFactoryInterface
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
     * @param $name
     * @param array $headers
     * @param array $variables
     * @param string $class
     * @return MessageInterface
     */
    public function createNew($name, array $headers = array(), array $variables = array(), $class = null)
    {
        $class = $this->getMessageClass($class);

        return new $class(Id::create(), $name, $headers, $variables);
    }

    /**
     * @param array $message
     * @param string $class
     * @return MessageInterface
     */
    public function createFromArray(array $message, $class = null)
    {
        $class = $this->getMessageClass($class);

        return new $class(
            $message[self::KEY_ID],
            $message[self::KEY_NAME],
            $message[self::KEY_HEADERS],
            $message[self::KEY_VARIABLES]
        );
    }

    /**
     * @param MessageInterface $message
     * @return array
     */
    public function toArray(MessageInterface $message)
    {
        return array(
            self::KEY_ID        => (string) $message->getId(),
            self::KEY_NAME      => $message->getName(),
            self::KEY_HEADERS   => $message->getHeaders(),
            self::KEY_VARIABLES => $message->getVariables(),
        );
    }
}
