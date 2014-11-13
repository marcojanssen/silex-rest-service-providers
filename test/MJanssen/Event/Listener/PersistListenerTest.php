<?php
namespace MJanssen\Event\Listener;

use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\GenericEvent;

class PersistListenerTest extends PHPUnit_Framework_TestCase
{
    public function testOnFinishHandle()
    {
        $listener = new PersistListener(
            $this->getObjectManagerMock()
        );

        $listener->onFinish(
            new GenericEvent()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getObjectManagerMock()
    {
        $objectManager = $this->getMockBuilder('\Doctrine\Common\Persistence\ObjectManager')
                              ->disableOriginalConstructor()
                              ->setMethods(array('persist'))
                              ->getMockForAbstractClass();

        $objectManager->expects($this->once())
                      ->method('persist');

        return $objectManager;
    }
} 