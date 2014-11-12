<?php
namespace MJanssen\Event;

use MJanssen\Assets\Entity\Test;
use PHPUnit_Framework_TestCase;

class RestGetEventTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->event = new RestGetEvent();
    }

    public function testSetEntity()
    {
        $testEntity = new Test();

        $this->event->setEntity($testEntity);

        $this->assertSame(
            $testEntity,
            $this->event->getEntity()
        );
    }

} 