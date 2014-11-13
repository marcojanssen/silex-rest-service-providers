<?php
namespace MJanssen\Event;

use PHPUnit_Framework_TestCase;
use Symfony\Component\Validator\Constraint;

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

    public function testSetGroups()
    {
        $groups = array(
            'Default'
        );

        $this->event->setGroups($groups);

        $this->assertSame(
            $groups,
            $this->event->getGroups()
        );
    }

    public function testSetConstraints()
    {
        $constraints = array(
            'foo' => 'baz'
        );

        $this->event->setConstraints($constraints);

        $this->assertSame(
            $constraints,
            $this->event->getConstraints()
        );
    }
} 