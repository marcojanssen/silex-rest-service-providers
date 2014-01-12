<?php
namespace MJanssen\Service;

use MJanssen\Service\ValidatorService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RequestValidatorService
{
    /**
     * @var Validator
     */
    protected $validator;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Validator $validator
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
        $this->validator->setValidatorConstrainClass($this->request->attributes->get('validator'));

        $this->validator->validate(
            $this->request->getContent()
        );

        if($this->validator->hasErrors()) {
            $errors = $this->validator->getErrors();

            $errorFormatted = array();
            foreach($errors as $error) {
                $name = str_replace(array('[',']'),'',$error->getPropertyPath());
                $errorFormatted[$name][] = $error->getMessage();
            }

            return array('errors' => $errorFormatted);
        }

        return null;
    }
}