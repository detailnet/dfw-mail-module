<?php

namespace Detail\Mail\Options;

use Detail\Core\Options\AbstractOptions;

class MessageFactoryOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $messageClass = 'Detail\Mail\Message\Message';

    /**
     * @return string
     */
    public function getMessageClass()
    {
        return $this->messageClass;
    }

    /**
     * @param string $messageClass
     */
    public function setMessageClass($messageClass)
    {
        $this->messageClass = $messageClass;
    }
}
