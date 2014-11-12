<?php
namespace MJanssen\Service;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class EntityServiceTest extends PHPUnit_Framework_TestCase
{
    public function testGetEntity()
    {
        $service = new EntityService(
            $this->getRepositoryMock()
        );

        $this->assertInstanceOf(
            'MJanssen\Assets\Entity\Test',
            $service->getEntity(
                'MJanssen\Assets\Entity\Test',
                1
            )
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