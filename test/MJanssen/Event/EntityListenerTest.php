<?php
namespace MJanssen\Event;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class EntityListenerTest extends PHPUnit_Framework_TestCase
{

    public function testEntitySetInEvent()
    {
        $event = new RestGetEvent();
        $event->setRepository(
            $this->getRepositoryMock()
        );

        $event->setIdentifier(1);

        $listener = new EntityListener();
        $listener->get($event);

        $this->assertInstanceOf(
            'MJanssen\Assets\Entity\Test',
            $event->getEntity()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getRepositoryMock()
    {
        $repository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
                           ->disableOriginalConstructor()
                           ->setMethods(array('find'))
                           ->getMock();

        $repository->expects($this->any())
                   ->method('find')
                   ->will($this->returnValue(
                        new Test()
                   ));

        return $repository;
    }
} 