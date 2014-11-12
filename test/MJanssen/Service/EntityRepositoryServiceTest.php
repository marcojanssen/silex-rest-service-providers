<?php
namespace MJanssen\Service;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class EntityRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testGetRepository()
    {
        $service = new EntityRepositoryService(
            $this->getEntityManagerMock()
        );

        $this->assertInstanceOf(
            '\Doctrine\ORM\EntityRepository',
            $service->get('MJanssen\Assets\Entity\Test')
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getEntityManagerMock()
    {
        $entityManager = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
                           ->disableOriginalConstructor()
                           ->setMethods(array('getRepository'))
                           ->getMock();

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
        return $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
                    ->disableOriginalConstructor()
                    ->getMock();
    }
} 