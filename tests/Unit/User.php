<?php
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegister()
    {
        $userData = [
            'username' => 'john_doe',
            'password' => 'password123',
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];

        $user = (new UserController)->register($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['username'], $user->username);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
    }
}
?>