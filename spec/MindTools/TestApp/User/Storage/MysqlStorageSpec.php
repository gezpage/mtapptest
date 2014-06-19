<?php

namespace spec\MindTools\TestApp\User\Storage;

use Doctrine\DBAL\Connection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MysqlStorageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindTools\TestApp\User\Storage\MysqlStorage');
        $this->shouldImplement('MindTools\TestApp\User\Storage\StorageInterface');
    }

    function let(Connection $dbal)
    {
        $this->beConstructedWith($dbal);
    }

    function it_should_create_a_user(Connection $dbal)
    {
        $dbal->insert('users', Argument::type('array'))
            ->shouldBeCalled();

        $dbal->lastInsertId()
            ->shouldBeCalled()
            ->willReturn(1);

        $user = $this->createUser('gez', 'Gez Page', 'gezpage@test.com', 'password');
        $user->shouldHaveType('MindTools\TestApp\Model\User');
    }
}
