<?php
namespace MJanssen\Service;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class ObjectServiceTest extends PHPUnit_Framework_TestCase
{
    public function testGetObject()
    {
        $service = new ObjectService(
            $this->getRepositoryMock()
        );

        $this->assertInstanceOf(
            'MJanssen\Assets\Entity\Test',
            $service->find(
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