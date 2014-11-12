<?php
namespace MJanssen\Event\Listener;

use MJanssen\Assets\Entity\Test;
use MJanssen\Assets\Transformer\TestTransformer;
use MJanssen\Event\GetEvent;
use PHPUnit_Framework_TestCase;

class TransformerListenerTest extends PHPUnit_Framework_TestCase
{
    public function testTransform()
    {
        $testEntity = new Test();

        $event = new GetEvent();
        $event->setObject($testEntity);

        $listener = new TransformerListener(
            new TestTransformer()
        );
        $listener->transform($event);

        $transformedEntity = $event->getObject();

        $this->assertSame(
            'Transformed',
            $transformedEntity->name
        );
    }

    /**
     * @expectedException RuntimeException
     * @expectedExceptionMessage Object is not set
     */
    public function testExceptionIfObjectIsNotSet()
    {
        $event = new GetEvent();

        $listener = new TransformerListener(
            new TestTransformer()
        );
        $listener->transform($event);
    }
} 