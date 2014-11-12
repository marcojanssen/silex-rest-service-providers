<?php
namespace MJanssen\Event;

use PHPUnit_Framework_TestCase;

class ObjectRepositoryListenerTest extends PHPUnit_Framework_TestCase
{
    public function testObjectRepositoryIsSetInEvent()
    {
        $event = new RestGetEvent();

        $event->setObjectManager(
            $this->getObjectManagerMock()
        );

        $event->setObjectName(
            'MJanssen\Assets\Entity\Test'
        );

        $listener = new ObjectRepositoryListener();
        $listener->setRepository($event);

        $this->assertInstanceOf(
            '\Doctrine\Common\Persistence\ObjectRepository',
            $event->getRepository()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectManagerMock()
    {
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                              ->disableOriginalConstructor()
                              ->setMethods(array('getRepository'))
                              ->getMockForAbstractClass();

        $entityManager->expects($this->any())
                      ->method('getRepository')
                      ->will($this->returnValue(
                          $this->getRepositoryMock()
                      ));

        return $entityManager;
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