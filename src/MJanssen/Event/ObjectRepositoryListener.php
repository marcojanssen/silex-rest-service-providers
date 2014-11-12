<?php
namespace MJanssen\Event;

use MJanssen\Service\ObjectRepositoryService;
use Symfony\Component\EventDispatcher\Event;

class ObjectRepositoryListener
{
    /**
     * @param Event $event
     */
    public function setRepository(Event $event)
    {
        $entityRepositoryService = new ObjectRepositoryService(
            $event->getObjectManager()
        );

        $event->setRepository(
            $entityRepositoryService->getRepository(
                $event->getEntityName()
            )
        );
    }
} 