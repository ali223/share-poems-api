<?php
namespace Feature\UserRegistrations;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class StoreTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function users_can_register()
    {
        $registrationData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret123',
            'passwordConfirmation' => 'secret123',
        ];

        $this->post(route('user-registrations.store'), $registrationData)
            ->seeJson([
                'name' => $registrationData['name'],
            ]);

        $this->seeInDatabase('users', [
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
        ]);

        $this->assertTrue(auth()->check());
        $this->assertEquals(
            $registrationData['email'], 
            auth()->user()->email
        );
    }
}
