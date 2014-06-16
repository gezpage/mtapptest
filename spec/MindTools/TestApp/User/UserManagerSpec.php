<?php

namespace spec\MindTools\TestApp\User;

use MindTools\TestApp\User\Storage\StorageInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\User\UserManager');
    }

    function let(StorageInterface $storage)
    {
        $this->shouldBeConstructedWith($storage);
    }

    function it_should_create_a_user()
    {
        $this->createUser('gez', 'Gez Page', 'gezpage@test.com', 'password');
    }
}
