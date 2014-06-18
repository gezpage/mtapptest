<?php

namespace MindTools\TestApp\Form\Validator;

/**
 * Class FormValidationException
 *
 * @package MindTools\TestApp\Form\Validator
 */
class FormValidationException extends \Exception
{
    /** @var array */
    protected $validationErrors = array();

    /**
     * @param array $validationErrors
     */
    public function setValidationErrors(array $validationErrors)
    {
        $this->validationErrors = $validationErrors;
    }

    /**
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
}
