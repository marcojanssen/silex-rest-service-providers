<?php
namespace MJanssen\Event\Listener;

use MJanssen\Event\ValidateEvent;
use Symfony\Component\Validator\Validator;

class ValidateListener
{
    /**
     * @var Validator\ValidatorInterface
     */
    protected $validator;

    /**
     * @param Validator\ValidatorInterface $validator
     */
    public function __construct(Validator\ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param ValidateEvent $event
     */
    public function onValidate(ValidateEvent $event)
    {
        $event->setResult(
            $this->validator->validate(
                $event->getSubject()
            )
        );
    }
}