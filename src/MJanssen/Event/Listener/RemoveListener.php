<?php
namespace MJanssen\Event\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\GenericEvent;

class RemoveListener
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param GenericEvent $event
     */
    public function onFinish(GenericEvent $event)
    {
        $this->objectManager->remove(
            $event->getSubject()
        );
    }
} 