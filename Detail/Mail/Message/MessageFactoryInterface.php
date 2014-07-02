<?php

namespace Detail\Mail\Message;

interface MessageFactoryInterface
{
    public function createMessage($name, array $headers = array(), array $variables = array());
} 
