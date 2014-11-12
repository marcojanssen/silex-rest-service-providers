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

    public function testSetEntityName()
    {
        $testName = 'MJanssen\Assets\Entity\Test';

        $this->event->setEntityName($testName);

        $this->assertSame(
            $testName,
            $this->event->getEntityName()
        );
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
    protected function getRepositoryMock()
    {
        return $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
                    ->disableOriginalConstructor()
                    ->getMock();
    }

} 