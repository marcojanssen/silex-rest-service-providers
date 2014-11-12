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

    public function testSetObjectName()
    {
        $testName = 'MJanssen\Assets\Entity\Test';

        $this->event->setObjectName($testName);

        $this->assertSame(
            $testName,
            $this->event->getObjectName()
        );
    }

    public function testSetObject()
    {
        $testEntity = new Test();

        $this->event->setObject($testEntity);

        $this->assertSame(
            $testEntity,
            $this->event->getObject()
        );
    }

    public function testSetObjectManager()
    {
        $repository = $this->getObjectManagerMock();

        $this->event->setObjectManager(
            $repository
        );

        $this->assertSame(
            $repository,
            $this->event->getObjectManager()
        );
    }

    public function testSetRepository()
    {
        $repository = $this->getObjectRepositoryMock();

        $this->event->setRepository(
            $repository
        );

        $this->assertSame(
            $repository,
            $this->event->getRepository()
        );
    }

    public function testSetIdentifier()
    {
        $identifier = 1;

        $this->event->setIdentifier($identifier);

        $this->assertSame(
            $identifier,
            $this->event->getIdentifier()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectRepositoryMock()
    {
        return $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectRepository')
                    ->disableOriginalConstructor()
                    ->getMockForAbstractClass();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectManagerMock()
    {
        return $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                    ->disableOriginalConstructor()
                    ->getMockForAbstractClass();
    }

} 