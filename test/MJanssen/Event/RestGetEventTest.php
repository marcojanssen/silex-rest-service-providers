<?php
namespace MJanssen\Event;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class RestGetEventTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->event = new RestGetEvent();
    }

    public function testSetEntity()
    {
        $testEntity = new Test();

        $this->event->setEntity($testEntity);

        $this->assertSame(
            $testEntity,
            $this->event->getEntity()
        );
    }

    public function testSetRepository()
    {
        $repository = $this->getRepositoryMock();

        $this->event->setRepository(
            $repository
        );

        $this->assertSame(
            $repository,
            $this->event->getRepository()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getRepositoryMock()
    {
        return $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
                    ->disableOriginalConstructor()
                    ->getMock();
    }

} 