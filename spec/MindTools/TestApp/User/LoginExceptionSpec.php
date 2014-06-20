<?php

namespace spec\MindTools\TestApp\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LoginExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\User\LoginException');
        $this->shouldHaveType('\Exception');
    }
}
