<?php
namespace MJanssen\Event\Listener;

use MJanssen\Event\GetEvent;
use PHPUnit_Framework_TestCase;

class ObjectManagerServiceListenerTest extends PHPUnit_Framework_TestCase
{
    public function testObjectRepositoryIsSetInEvent()
    {
        $event = new GetEvent();

        $event->setObjectManager(
            $this->getObjectManagerMock()
        );

        $event->setObjectName(
            'MJanssen\Assets\Entity\Test'
        );

        $listener = new ObjectManagerListener();
        $listener->setObjectRepository($event);

        $this->assertInstanceOf(
            '\Doctrine\Common\Persistence\ObjectRepository',
            $event->getObjectRepository()
        );
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Object name is not set
     */
    public function testExceptionIfObjectNameIsNotSet()
    {
        $event = new GetEvent();

        $event->setObjectManager(
            $this->getObjectManagerMock()
        );

        $listener = new ObjectManagerListener();
        $listener->setObjectRepository($event);
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Object manager is not set
     */
    public function testExceptionIfObjectManagerIsNotSet()
    {
        $event = new GetEvent();

        $event->setObjectName(
            'MJanssen\Assets\Entity\Test'
        );

        $listener = new ObjectManagerListener();
        $listener->setObjectRepository($event);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectManagerMock()
    {
        $objectManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                              ->disableOriginalConstructor()
                              ->setMethods(array('getRepository'))
                              ->getMockForAbstractClass();

        $objectManager->expects($this->any())
                      ->method('getRepository')
                      ->will($this->returnValue(
                          $this->getRepositoryMock()
                      ));

        return $objectManager;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getRepositoryMock()
    {
        return $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectRepository')
                    ->disableOriginalConstructor()
                    ->getMock();
    }

} 