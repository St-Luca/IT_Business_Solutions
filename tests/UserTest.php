<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function testUserConstructorSetsProperties(): void
    {
        $user = new User('user-id', 'username', 'First', 'Last');

        $this->assertEquals('user-id', $user->id);
        $this->assertEquals('username', $user->userName);
        $this->assertEquals('First', $user->firstName);
        $this->assertEquals('Last', $user->lastName);
    }
}
