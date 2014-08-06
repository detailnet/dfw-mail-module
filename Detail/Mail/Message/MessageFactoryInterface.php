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
}
