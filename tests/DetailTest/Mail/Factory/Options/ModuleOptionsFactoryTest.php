<?php

namespace DetailTest\Mail\Factory\Options;

use PHPUnit_Framework_TestCase as TestCase;

use Zend\ServiceManager\ServiceManager;

use Detail\Mail\Factory\Options\ModuleOptionsFactory;

class ModuleOptionsFactoryTest extends TestCase
{
    public function testCreateService()
    {
        $moduleOptions = $this->createModuleOptions(array('detail_mail' => array()));

        $this->assertInstanceOf('Detail\Mail\Options\ModuleOptions', $moduleOptions);
    }

    public function testCreateServiceThrowsExceptionForInvalidConfiguration()
    {
        $this->setExpectedException('Detail\Mail\Exception\ConfigException');
        $this->createModuleOptions();
    }

    protected function createModuleOptions(array $options = array())
    {
        $serviceManager = new ServiceManager();
        $serviceManager->setService('Config', $options);

        $factory = new ModuleOptionsFactory();

        return $factory->createService($serviceManager);
    }
}
