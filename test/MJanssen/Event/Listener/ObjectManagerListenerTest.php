<?php
namespace MJanssen\Event\Listener;

use MJanssen\Event\GetEvent;
use PHPUnit_Framework_TestCase;

class ObjectManagerServiceListenerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->event = new GetEvent();

        $this->event->setObjectManager(
            $this->getObjectManagerMock()
        );

        $this->event->setObjectName('MJanssen\Assets\Entity\Test');

        $this->listener = new ObjectManagerListener();

    }


    public function testObjectRepositoryIsSetInEvent()
    {
        $this->listener->setObjectRepository($this->event);

        $this->assertInstanceOf(
            '\Doctrine\Common\Persistence\ObjectRepository',
            $this->event->getObjectRepository()
        );
    }

    public function testFlush()
    {
        $objectManager = $this->getObjectManagerMock();

        $this->setSingleMethodExpectation(
            $objectManager,
            'flush'
        );

        $this->event->setObjectManager($objectManager);

        $this->listener->flush($this->event);
    }

    public function testMerge()
    {
        $objectManager = $this->getObjectManagerMock();

        $this->setSingleMethodExpectation(
            $objectManager,
            'merge'
        );

        $this->event->setObjectManager($objectManager);


        $this->listener->merge($this->event);
    }

    public function testPersist()
    {
        $objectManager = $this->getObjectManagerMock();

        $this->setSingleMethodExpectation(
            $objectManager,
            'persist'
        );

        $this->event->setObjectManager($objectManager);



        $this->listener->persist($this->event);
    }

    public function testRemove()
    {
        $objectManager = $this->getObjectManagerMock();

        $this->setSingleMethodExpectation(
            $objectManager,
            'remove'
        );

        $this->event->setObjectManager($objectManager);


        $this->listener->remove($this->event);
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Object name is not set
     */
    public function testExceptionIfObjectNameIsNotSet()
    {
        $this->event->setObjectName(null);
        $this->listener->setObjectRepository($this->event);
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

        $this->listener->setObjectRepository($event);
    }



    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectManagerMock()
    {
        $objectManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                              ->disableOriginalConstructor()
                              ->setMethods(array('getRepository', 'flush', 'persist', 'merge', 'remove'))
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
    protected function setSingleMethodExpectation($mock, $methodName, $value = null)
    {
        $mock->expects($this->once())
             ->method($methodName)
             ->will($this->returnValue($value));

        return $mock;
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