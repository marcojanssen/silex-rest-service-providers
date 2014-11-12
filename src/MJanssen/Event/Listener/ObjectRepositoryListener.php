<?php
namespace MJanssen\Event\Listener;

use RuntimeException;
use MJanssen\Service\ObjectRepositoryService;
use Symfony\Component\EventDispatcher\Event;

class ObjectRepositoryListener
{
    /**
     * @param Event $event
     */
    public function setObject(Event $event)
    {
        if(null === $event->getObjectRepository()) {
            throw new RuntimeException('Object repository is not set');
        }

        if(null === $event->getIdentifier()) {
            throw new RuntimeException('Object identifier is not set');
        }

        $objectRepositoryService = new ObjectRepositoryService(
            $event->getObjectRepository()
        );

        $object = $objectRepositoryService->find(
            $event->getIdentifier()
        );

        if(null === $object) {
            $event->stopPropagation();
        } else {
            $event->setObject(
                $objectRepositoryService->find(
                    $event->getIdentifier()
                )
            );
        }
    }
} 