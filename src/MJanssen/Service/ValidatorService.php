<?php
namespace MJanssen\Service;

use Symfony\Component\HttpFoundation\Request;

class ValidatorService
{

    public function __construct()
    {
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
                $errorFormatted[$error->getPropertyPath()][] = $error->getMessage();
            }

            return array('errors' => $errorFormatted);
        }

        return null;
    }
}