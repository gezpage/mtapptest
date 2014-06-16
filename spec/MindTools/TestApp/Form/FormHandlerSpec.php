<?php

namespace spec\MindTools\TestApp\Form;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\Form\FormHandler');
    }
}
