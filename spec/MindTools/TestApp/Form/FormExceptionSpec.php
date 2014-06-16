<?php

namespace spec\MindTools\TestApp\Form;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\Form\FormException');
        $this->shouldHaveType('\Exception');
    }
}
