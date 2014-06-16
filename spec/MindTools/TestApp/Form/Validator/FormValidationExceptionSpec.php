<?php

namespace spec\MindTools\TestApp\Form\Validator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormValidationExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\Form\Validator\FormValidationException');
        $this->shouldHaveType('\Exception');
    }
}
