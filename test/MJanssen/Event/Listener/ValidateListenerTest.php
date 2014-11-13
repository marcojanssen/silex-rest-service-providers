<?php
namespace MJanssen\Event\Listener;

use MJanssen\Event\ValidateEvent;
use PHPUnit_Framework_TestCase;

class ValidateListenerTest extends PHPUnit_Framework_TestCase
{
    public function testOnValidateHandle()
    {
        $listener = new ValidateListener(
            $this->getValidatorMock()
        );

        $listener->onValidate(
            new ValidateEvent()
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getValidatorMock()
    {
        return $this->getMockBuilder('Symfony\Component\Validator\Validator\ValidatorInterface')
                    ->disableOriginalConstructor()
                    ->setMethods(array('validate'))
                    ->getMockForAbstractClass();
    }
} 