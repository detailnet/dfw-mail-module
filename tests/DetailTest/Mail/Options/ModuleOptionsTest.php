<?php

namespace DetailTest\Mail\Options;

class ModuleOptionsTest extends OptionsTestCase
{
    /**
     * @var \Detail\Mail\Options\ModuleOptions
     */
    protected $options;

    protected function setUp()
    {
        $this->options = $this->getOptions(
            'Detail\Bernard\Mail\ModuleOptions',
            array(
                'getDefaultMailer',
                'setDefaultMailer',
            )
        );
    }

    public function testDefaultMailerCanBeSet()
    {
        $defaultMailer = 'New/Default/Mailer/Class';

        $this->assertEquals('Detail\Mail\Service\SimpleMailer', $this->options->getDefaultMailer());

        $this->options->setDefaultMailer($defaultMailer);

        $this->assertEquals($defaultMailer, $this->options->getDefaultMailer());
    }
}
