<?php

namespace spec\MindTools\TestApp\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PasswordHasherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\User\PasswordHasher');
        $this->shouldImplement('MindTools\TestApp\User\HasherInterface');
    }

    function it_should_hash_a_password_string()
    {
        $this->hash('password')
            ->shouldBeString();
    }

    function it_should_verify_a_password_string_to_a_hash()
    {
        $this->verify('password', '$2y$10$AmYd..xODv7aY1lBQlc6/.llcwyZb/OObekhLM6nAKbvOzdtOQlT.')
            ->shouldReturn(true);
    }

    function it_should_fail_verification_of_a_wrong_password_to_a_hash()
    {
        $this->verify('bad_password', '$2y$10$AmYd..xODv7aY1lBQlc6/.llcwyZb/OObekhLM6nAKbvOzdtOQlT.')
            ->shouldReturn(false);
    }
}
