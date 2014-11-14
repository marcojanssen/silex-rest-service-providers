<?php
namespace MJanssen\Event\Listener;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\GenericEvent;

class FlushListener
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
     * @param Event $event
     */
    public function onFinish(GenericEvent $event)
    {
        $this->objectManager->flush();
    }
} 