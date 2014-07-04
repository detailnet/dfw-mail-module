<?php

namespace Detail\Mail\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;

class LoggingListener extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->attachEvent($events, 'Detail\Mail\Service\SimpleMailer', 'send.pre', 'onBeforeSimpleMailerSend');
        $this->attachEvent($events, 'Detail\Mail\Service\SimpleMailer', 'send.post', 'onAfterSimpleMailerSend');
    }

    public function onBeforeSimpleMailerSend(EventInterface $e)
    {
//        var_dump('send.pre', $e);
    }

    public function onAfterSimpleMailerSend(EventInterface $e)
    {
//        var_dump('send.post', $e);
    }

    /**
     * Attach a listener to an event
     *
     * @param EventManagerInterface $events
     * @param string $id Identifier for event emitting component
     * @param string $event
     * @param callable $callback PHP Callback
     * @return void
     */
    protected function attachEvent(EventManagerInterface $events, $id, $event, $callback)
    {
        /** @var \Zend\EventManager\SharedEventManager $sharedEvents */
        $sharedEvents = $events->getSharedManager();

        $this->listeners[] = $sharedEvents->attach($id, $event, array($this, $callback), 100);
    }
}
