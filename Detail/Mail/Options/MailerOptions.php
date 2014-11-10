<?php

namespace Detail\Mail\Options;

use Detail\Core\Options\AbstractOptions;
use Detail\Core\Options\TypeAwareOptionsTrait;

class MailerOptions extends AbstractOptions
{
    use TypeAwareOptionsTrait;

    /**
     * @var boolean
     */
    protected $useProxy = false;

    /**
     * @return boolean
     */
    public function getUseProxy()
    {
        return $this->useProxy;
    }

    /**
     * @param boolean $useProxy
     */
    public function setUseProxy($useProxy)
    {
        $this->useProxy = $useProxy;
    }
}
