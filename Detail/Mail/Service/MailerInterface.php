<?php

namespace Detail\Mail\Service;

use Detail\Mail\Message\MessageInterface;

interface MailerInterface
{
    /**
     * @param string $name
     * @param array $headers Message headers
     * @param array $variables
     * @return MessageInterface
     */
    public function compose($name, array $headers = array(), array $variables = array());

    /**
     * @param MessageInterface $message
     */
    public function send(MessageInterface $message);
}
