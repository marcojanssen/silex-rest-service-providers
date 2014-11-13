<?php
namespace MJanssen\Event\Listener;

use Doctrine\Common\Persistence\ObjectManager;

class FlushListener
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function onFinish()
    {
        $this->objectManager->flush();
    }
} 