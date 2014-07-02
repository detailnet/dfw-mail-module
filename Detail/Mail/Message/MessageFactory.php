<?php

namespace Detail\Mail\Message;

class MessageFactory
    implements MessageFactoryInterface
{
    public function createMessage($name, array $headers = array(), array $variables = array())
    {
        $message = new Message(Id::create(), $name);

        return $message;
    }
} 
