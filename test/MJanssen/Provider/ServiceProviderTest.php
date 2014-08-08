<?php
namespace MJanssen\Provider;

use JMS\Serializer\SerializerBuilder;
use PHPUnit_Framework_TestCase;
use Silex\Application;
use Silex\Provider\ValidatorServiceProvider;
use stdClass;

class ServiceProviderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test if services are registered
     */
    public function testIfServicesAreRegistered()
    {
        $app = $this->getMockApplication();

        $this->assertTrue(isset($app['serializer']));
        $this->assertTrue(isset($app['serializer.object.constructor']));
        $this->assertTrue(isset($app['doctrine.extractor']));
        $this->assertTrue(isset($app['doctrine.hydrator']));
        $this->assertTrue(isset($app['doctrine.resolver']));
        $this->assertTrue(isset($app['service.validator']));
        $this->assertTrue(isset($app['service.transformer']));
        $this->assertFalse(isset($app['foo']));
    }

    public function testSerializerServiceInstantiation()
    {
        $app = $this->getMockApplication();

        $this->assertInstanceOf('JMS\Serializer\Serializer', $app['serializer']);
    }

    public function testSerializerDefaultObjectConstructorInstantiation()
    {
        $app = $this->getMockApplication();


        $this->assertInstanceOf('JMS\Serializer\Construction\UnserializeObjectConstructor', $app['serializer.object.constructor']);
    }

    public function testSerializerDoctrineObjectConstructorInstantiation()
    {
        $app = $this->getMockApplication();
        $app['doctrine'] = $this->getMock('\Doctrine\Common\Persistence\ManagerRegistry');

        $this->assertInstanceOf('JMS\Serializer\Construction\DoctrineObjectConstructor', $app['serializer.object.constructor']);
    }

    public function testSerializerReceivesCustomHandlersViaConfiguration()
    {
        $app = $this->getMockApplication();
        $app['serializer.handlers'] = array(
            'MJanssen\Fixtures\Serializer\StdClassHandler'
        );
        
        $class      = new stdClass;
        $serializer = $app['serializer'];
        $serializer->serialize($class, 'json');
        $this->assertTrue($class->serialized);
    }

    /**
     * Test if extractor service can be instantiated
     */
    public function testTransformerService()
    {
        $app = $this->getMockApplication();

        $app['request'] = $this->getMock('Symfony\Component\HttpFoundation\Request');

        $this->assertInstanceOf('MJanssen\Service\TransformerService', $app['service.transformer']);
    }

    /**
     * Test if extractor service can be instantiated
     */
    public function testExtractorService()
    {
        $app = $this->getMockApplication();

        $app['serializer'] = $app->share(function($app) {
            return SerializerBuilder::create()->build();
        });

        $app['request'] = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $app['service.transformer'] = $this->getMock('MJanssen\Service\TransformerService', array(), array(), '', false);

        $this->assertInstanceOf('MJanssen\Service\ExtractorService', $app['doctrine.extractor']);
    }

    /**
     * Test if extractor service can be instantiated
     */
    public function testHydratorService()
    {
        $app = $this->getMockApplication();

        $app['serializer'] = $app->share(function($app) {
            return SerializerBuilder::create()->build();
        });

        $app['request'] = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $app['service.transformer'] = $this->getMock('MJanssen\Service\TransformerService', array(), array(), '', false);

        $this->assertInstanceOf('MJanssen\Service\HydratorService', $app['doctrine.hydrator']);
    }

    /**
     * Test if resolver service can be instantiated
     */
    public function testResolverService()
    {
        $app = $this->getMockApplication();

        $app['orm.em'] = $this->getMock('\Doctrine\ORM\EntityManager',
            array('getRepository', 'getClassMetadata', 'persist', 'flush'), array(), '', false);

        $this->assertInstanceOf('MJanssen\Service\ResolverService', $app['doctrine.resolver']);
    }

    public function testRestEntityServiceInstantiation()
    {
        $app = $this->getMockApplication();

        $app['request'] = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $this->assertInstanceOf('MJanssen\Service\RestEntityService', $app['service.rest.entity']);
    }

    /**
     * Test if validator service can be instantiated
     */
    public function testValidatorService()
    {
        //$app = $this->getMockApplication();
        //$this->assertInstanceOf('MJanssen\Service\ValidatorService', $app['service.validator']);
    }

    /**
     * Test if filter request service can be instantiated
     */
    public function testRequestFilterService()
    {
        $app = $this->getMockApplication();
        $app['request'] = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $this->assertInstanceOf('MJanssen\Service\RequestFilterService', $app['service.request.filter']);
    }

    /**
     * Get a default silex application
     * @return Application
     */
    protected function getMockApplication()
    {
        $app = new Application();

        $app->register(
            new ServiceProvider()
        );

        return $app;
    }


}