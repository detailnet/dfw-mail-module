<?php

namespace Detail\Mail\Listener;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;



use Detail\Mail\Message\MessageInterface;
use Detail\Mail\Service\SimpleMailer;

use RuntimeException;

class LoggingListener extends AbstractListener
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        /** @todo Move mailer ID assertion to AbstractListener */
        $mailerId = $this->getMailerId();

        if (!$mailerId) {
            throw new RuntimeException('No mailer ID set');
        }

        $this->attachEvent($events, $mailerId, 'send.pre', 'onBeforeSimpleMailerSend');
        $this->attachEvent($events, $mailerId, 'send.post', 'onAfterSimpleMailerSend');
    }

    public function onBeforeSimpleMailerSend(EventInterface $e)
    {
    }

    public function onAfterSimpleMailerSend(EventInterface $e)
    {
        /** @var \Detail\Mail\Service\MailerInterface $mailer */
        $mailer = $e->getTarget();
        $message = $e->getParam('message');

        if ($message === null) {
            throw new RuntimeException(
                sprintf('Event "%s" is missing param "message"', $e->getName())
            );
        } else if (!$message instanceof MessageInterface) {
            throw new RuntimeException(
                sprintf(
                    'Event "%s" has invalid value for param "message"; ' .
                    'expected Detail\Mail\Message\MessageInterface object but got ' .
                    is_object($message) ? get_class($message) : gettype($message),
                    $e->getName()
                )
            );
        }

        $headersText = preg_replace(
            '/\s+/', ' ',
            str_replace(PHP_EOL, ' ', var_export($message->getHeaders(), true))
        );

        if ($mailer instanceof SimpleMailer) {
            /** @var \Detail\Mail\Service\SimpleMailer $mailer */
            $driverClass = get_class($mailer->getDriver());

            switch ($driverClass) {
                case 'Detail\Mail\Driver\Bernard\BernardDriver':
                    $text = 'Queued email message "%s" of type "%s" (headers: "%s", driver: %s)';
                    break;
                default:
                    $text = 'Sent email message "%s" of type "%s" (headers: "%s", driver: %s)';
                    break;
            }

            $text = sprintf(
                $text,
                $message->getId(),
                $message->getName(),
                $headersText,
                $driverClass
            );
        } else {
            $text = sprintf(
                'Sent email message "%s" of type "%s" (headers: "%s")',
                $message->getId(),
                $message->getName(),
                $headersText
            );
        }

        $this->log($text);
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
