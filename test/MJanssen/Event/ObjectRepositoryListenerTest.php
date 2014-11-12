<?php
namespace MJanssen\Event;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class ObjectRepositoryListenerTest extends PHPUnit_Framework_TestCase
{

    public function testObjectSetInEvent()
    {
        $event = new RestGetEvent();
        $event->setObjectRepository(
            $this->getObjectRepositoryMock()
        );

        $event->setIdentifier(1);

        $listener = new ObjectRepositoryListener();
        $listener->setObject($event);

        $this->assertInstanceOf(
            'MJanssen\Assets\Entity\Test',
            $event->getObject()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectRepositoryMock()
    {
        $objectRepository = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectRepository')
                                 ->disableOriginalConstructor()
                                 ->setMethods(array('find'))
                                 ->getMockForAbstractClass();

        $objectRepository->expects($this->any())
                         ->method('find')
                         ->will($this->returnValue(
                              new Test()
                         ));

        return $objectRepository;
    }
} 