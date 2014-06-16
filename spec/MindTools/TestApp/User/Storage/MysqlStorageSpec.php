<?php

namespace spec\MindTools\TestApp\User\Storage;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MysqlStorageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\User\Storage\MysqlStorage');
        $this->shouldImplement('MindTools\TestApp\User\Storage\StorageInterface');
    }

    function it_should_create_a_user()
    {
        $user = $this->createUser('gez', 'Gez Page', 'gezpage@test.com', 'password');
        $user->shouldHaveType('MindTools\TestApp\Model\User');
    }
}
