<?php
namespace MJanssen\Service;

use JMS\Serializer\SerializerBuilder;
use MJanssen\Assets\Entity\Test;

class HydratorServiceTest extends \PHPUnit_Framework_TestCase
{

    protected $testData = array('id' => 1, 'name' => 'foo');

    /**
     * Test hydrate single entity
     */
    public function testHydrateEntity()
    {
        $serializer = SerializerBuilder::create()->build();
        $service    = new HydratorService($serializer, $this->getTransformer());

        $result = $service->hydrateEntity($this->testData, 'MJanssen\Assets\Entity\Test');

        $this->assertEquals(
            $this->createEntity($this->testData),
            $result
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getTransformer()
    {
        $transformer = $this->getMock('MJanssen\Service\TransformerService', array('transformHydrateData', 'getTransformer'), array(), '', false);

        $transformer->expects($this->any())
            ->method('transformHydrateData')
            ->will($this->returnValue($this->testData));

        return $transformer;
    }

    /**
     * Create a mock entity
     * @param $args
     * @return Foo
     */
    protected function createEntity($args)
    {
        $entity = new Test;
        $entity->id = $args['id'];
        $entity->name = $args['name'];
        return $entity;
    }
}