<?php
namespace MJanssen\Service;

use MJanssen\Service\ValidatorService;
use Symfony\Component\HttpFoundation\Request;

class RequestValidatorService
{
    /**
     * @var ValidatorService
     */
    protected $validator;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param ValidatorService $validator
     * @param Request $request
     */
    public function __construct(ValidatorService $validator, Request $request)
    {
        $this->validator = $validator;
        $this->request = $request;
    }

    /**
     * Validates incoming request
     */
    public function validateRequest()
    {
        $this->validator->setValidatorConstrainClass(
            $this->request->attributes->get('validator')
        );

        $this->validator->validate(
            $this->request->getContent()
        );

        if($this->validator->hasErrors()) {
            $errors = $this->validator->getErrors();

            $errorFormatted = array();
            foreach($errors as $error) {
                $errorFormatted[$error->getPropertyPath()][] = $error->getMessage();
            }

            return array('errors' => $errorFormatted);
        }

        return null;
    }
}