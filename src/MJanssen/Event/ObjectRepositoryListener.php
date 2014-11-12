<?php
namespace MJanssen\Event;

use MJanssen\Service\ObjectRepositoryService;
use Symfony\Component\EventDispatcher\Event;

class ObjectRepositoryListener
{
    /**
     * @param Event $event
     */
    public function setObject(Event $event)
    {
        $objectRepositoryService = new ObjectRepositoryService(
            $event->getObjectRepository()
        );

        $event->setObject(
            $objectRepositoryService->find(
                $event->getIdentifier()
            )
        );
    }
} 