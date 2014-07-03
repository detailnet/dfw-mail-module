<?php

namespace Detail\Mail\Driver\MtMail;

use Detail\Mail\Driver\DriverInterface;
use Detail\Mail\Message\MessageInterface;

use MtMail\Service\Mail as MtMail;

class MtMailDriver
    implements DriverInterface
{
    /**
     * @var MtMail
     */
    protected $mtMail = null;

    /**
     * @var string
     */
    protected $templatePath = 'mail';

    /**
     * @return string
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }

    /**
     * @param string $templatePath
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;
    }

    /**
     * @param MtMail $mtMail
     */
    public function __construct(MtMail $mtMail)
    {
        $this->mtMail = $mtMail;
    }

    /**
     * @param MessageInterface $message Message
     */
    public function send(MessageInterface $message)
    {
        $template = sprintf('%s/%s.phtml', $this->getTemplatePath(), $message->getName());
        $message = $this->mtMail->compose(
            $message->getHeaders(), $template, $message->getVariables()
        );

        $this->mtMail->send($message);
    }
}
