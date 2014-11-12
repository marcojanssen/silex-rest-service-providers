<?php
namespace MJanssen\Event;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class ObjectListenerTest extends PHPUnit_Framework_TestCase
{

    public function testObjectSetInEvent()
    {
        $event = new RestGetEvent();
        $event->setRepository(
            $this->getRepositoryMock()
        );

        $event->setIdentifier(1);

        $listener = new ObjectListener();
        $listener->setObject($event);

        $this->assertInstanceOf(
            'MJanssen\Assets\Entity\Test',
            $event->getObject()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getRepositoryMock()
    {
        $repository = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectRepository')
                           ->disableOriginalConstructor()
                           ->setMethods(array('find'))
                           ->getMockForAbstractClass();

        $repository->expects($this->any())
                   ->method('find')
                   ->will($this->returnValue(
                        new Test()
                   ));

        return $repository;
    }
} 