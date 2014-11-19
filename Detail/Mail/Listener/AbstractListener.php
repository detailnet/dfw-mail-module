<?php

namespace Detail\Mail\Listener;

use Psr\Log\LoggerAwareInterface;

use Detail\Log\Service\LoggerAwareTrait;

use Zend\EventManager\ListenerAggregateTrait;

abstract class AbstractListener implements
    ListenerInterface,
    LoggerAwareInterface
{
    use ListenerAggregateTrait;
    use LoggerAwareTrait;

    /**
     * @var string
     */
    protected $mailerId;

    /**
     * @return string
     */
    public function getMailerId()
    {
        return $this->mailerId;
    }

    /**
     * @param string $mailerId
     */
    public function setMailerId($mailerId)
    {
        $this->mailerId = $mailerId;

        $this->setLoggerPrefix($mailerId);
    }
}
