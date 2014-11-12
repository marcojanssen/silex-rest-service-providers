<?php
namespace MJanssen\Service;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class ObjectManagerServiceTest extends PHPUnit_Framework_TestCase
{
    public function testGetRepository()
    {
        $service = new ObjectManagerService(
            $this->getObjectManagerMock()
        );

        $this->assertInstanceOf(
            '\Doctrine\Common\Persistence\ObjectRepository',
            $service->getRepository('MJanssen\Assets\Entity\Test')
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
                          $this->getObjectRepositoryMock()
                      ));

        return $entityManager;
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
} 