<?php
namespace MJanssen\Event;

use MJanssen\Service\ObjectService;
use Symfony\Component\EventDispatcher\Event;

class ObjectListener
{
    /**
     * @param Event $event
     */
    public function setObject(Event $event)
    {
        $objectService = new ObjectService(
            $event->getRepository()
        );

        $event->setObject(
            $objectService->find(
                $event->getIdentifier()
            )
        );
    }
} 