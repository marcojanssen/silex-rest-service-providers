<?php
namespace MJanssen\Event;

use PHPUnit_Framework_TestCase;

class ValidateEventTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->event = new ValidateEvent();
    }

    public function testSetResult()
    {
        $result = array(
            'foo' => 'baz'
        );

        $this->event->setResult($result);

        $this->assertSame(
            $result,
            $this->event->getResult()
        );
    }
} 