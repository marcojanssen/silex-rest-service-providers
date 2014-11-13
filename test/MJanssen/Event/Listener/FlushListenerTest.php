<?php
namespace MJanssen\Event\Listener;

use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\Event;

class FlushListenerTest extends PHPUnit_Framework_TestCase
{
    public function testOnFinishHandle()
    {
        $listener = new FlushListener(
            $this->getObjectManagerMock()
        );

        $listener->onFinish(
            new Event()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectManagerMock()
    {
        $objectManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                              ->disableOriginalConstructor()
                              ->setMethods(array('flush'))
                              ->getMockForAbstractClass();

        $objectManager->expects($this->once())
                      ->method('flush');

        return $objectManager;
    }
} 