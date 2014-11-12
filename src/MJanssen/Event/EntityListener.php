<?php
namespace MJanssen\Event;

use MJanssen\Service\EntityService;
use Symfony\Component\EventDispatcher\Event;

class EntityListener
{
    /**
     * @param Event $event
     */
    public function get(Event $event)
    {
        $entityService = new EntityService(
            $event->getRepository()
        );

        $entity = $entityService->get(
            $event->getIdentifier()
        );

        $event->setEntity($entity);
    }
} 