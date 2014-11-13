<?php
namespace MJanssen\Event\Listener;

use PHPUnit_Framework_TestCase;
use Symfony\Component\EventDispatcher\GenericEvent;

class RemoveListenerTest extends PHPUnit_Framework_TestCase
{
    public function testOnFinishHandle()
    {
        $listener = new RemoveListener(
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
                              ->setMethods(array('remove'))
                              ->getMockForAbstractClass();

        $objectManager->expects($this->once())
                      ->method('remove');

        return $objectManager;
    }
} 