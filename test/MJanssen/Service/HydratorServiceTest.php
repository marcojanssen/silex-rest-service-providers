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
        $transformer = $this->getTransformerMock();

        $transformer->expects($this->once())
                    ->method('transformHydrateData')
                    ->will($this->returnValue($this->testData));

        $service = new HydratorService(
            SerializerBuilder::create()->build(),
            $transformer
        );

        $this->assertEquals(
            $this->createEntity($this->testData),
            $service->hydrateEntity($this->testData, 'MJanssen\Assets\Entity\Test')
        );
    }

    public function testIfEmptyDataIsConvertedToArray()
    {
        $transformer = $this->getTransformerMock();
        $transformer->expects($this->once())
                    ->method('transformHydrateData')
                    ->with(array());

        $service    = new HydratorService(
            SerializerBuilder::create()->build(),
            $transformer
        );

        $service->hydrateEntity(null, 'MJanssen\Assets\Entity\Test');
    }

    public function testIfDataIsDecodedFromJsonToArray()
    {
        $transformer = $this->getTransformerMock();
        $transformer->expects($this->once())
            ->method('transformHydrateData')
            ->with(array(1));

        $service    = new HydratorService(
            SerializerBuilder::create()->build(),
            $transformer
        );

        $service->hydrateEntity(json_encode(array(1)), 'MJanssen\Assets\Entity\Test');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getTransformerMock()
    {
        return $this->getMock('MJanssen\Service\TransformerService', array('transformHydrateData', 'getTransformer'), array(), '', false);
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