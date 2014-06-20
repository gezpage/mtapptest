<?php

namespace spec\MindTools\TestApp\User\Verification;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VerificationExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\User\Verification\VerificationException');
        $this->shouldHaveType('\Exception');
    }
}
