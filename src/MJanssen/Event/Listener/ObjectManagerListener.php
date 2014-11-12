<?php
namespace MJanssen\Event\Listener;

use RuntimeException;
use MJanssen\Service\ObjectManagerService;
use Symfony\Component\EventDispatcher\Event;


class ObjectManagerListener
{
    /**
     * @param Event $event
     */
    public function setObjectRepository(Event $event)
    {
        if(null === $event->getObjectName()) {
            throw new RuntimeException('Object name is not set');
        }

        if(null === $event->getObjectManager()) {
            throw new RuntimeException('Object manager is not set');
        }

        $objectManagerService = new ObjectManagerService(
            $event->getObjectManager()
        );

        $event->setObjectRepository(
            $objectManagerService->getObjectRepository(
                $event->getObjectName()
            )
        );
    }

    /**
     * @param Event $event
     */
    public function flush(Event $event)
    {
        $event->getObjectManager()->flush();
    }

    /**
     * @param Event $event
     */
    public function merge(Event $event)
    {
        $event->getObjectManager()->merge(
            $event->getObject()
        );
    }

    /**
     * @param Event $event
     */
    public function persist(Event $event)
    {
        $event->getObjectManager()->persist(
            $event->getObject()
        );
    }

    /**
     * @param Event $event
     */
    public function remove(Event $event)
    {
        $event->getObjectManager()->remove(
            $event->getObject()
        );
    }
} 