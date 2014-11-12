<?php
namespace MJanssen\Event\Listener;

use RuntimeException;
use MJanssen\Transformer\TransformerInterface;
use Symfony\Component\EventDispatcher\Event;

class TransformerListener
{
    /**
     * @param TransformerInterface $transformer
     */
    public function __construct(TransformerInterface $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param Event $event
     */
    public function transform(Event $event)
    {
        if(null === $event->getObject()) {
            throw new RuntimeException('Object is not set');
        }

        $event->setObject(
            $this->transformer->transform(
                $event->getObject()
            )
        );
    }
} 