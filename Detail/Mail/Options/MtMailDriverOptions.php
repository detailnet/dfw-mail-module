<?php

namespace Detail\Mail\Options;

use Detail\Core\Options\AbstractOptions;

class MtMailDriverOptions extends AbstractOptions
{
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
}
