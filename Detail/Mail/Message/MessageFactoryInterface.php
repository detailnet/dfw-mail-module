<?php

namespace Detail\Mail\Message;

interface MessageFactoryInterface
{
    /**
     * @param $name
     * @param array $headers
     * @param array $variables
     * @return MessageInterface
     */
    public function createNew($name, array $headers = array(), array $variables = array());

    /**
     * @param array $message
     * @return MessageInterface
     */
    public function createFromArray(array $message);

    /**
     * @param MessageInterface $message
     * @return array
     */
    public function toArray(MessageInterface $message);
} 
