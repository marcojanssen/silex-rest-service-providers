<?php
namespace MJanssen\Service;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class ObjectRepositoryServiceTest extends PHPUnit_Framework_TestCase
{
    public function testGetObject()
    {
        $service = new ObjectRepositoryService(
            $this->getObjectRepositoryMock()
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