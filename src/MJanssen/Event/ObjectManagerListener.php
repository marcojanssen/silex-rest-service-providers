<?php
namespace MJanssen\Event;

use MJanssen\Service\ObjectManagerService;
use Symfony\Component\EventDispatcher\Event;

class ObjectManagerListener
{
    /**
     * @param Event $event
     */
    public function setRepository(Event $event)
    {
        $objectManagerService = new ObjectManagerService(
            $event->getObjectManager()
        );

        $event->setRepository(
            $objectManagerService->getRepository(
                $event->getObjectName()
            )
        );
    }
} 