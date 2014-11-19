<?php

namespace Detail\Mail\Driver;

use Detail\Mail\Message\MessageInterface;

interface DriverInterface
{
    /**
     * @param MessageInterface $message Message
     */
    public function send(MessageInterface $message);
} 
