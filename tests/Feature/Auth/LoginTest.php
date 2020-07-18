<?php
namespace Feature\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function users_can_login_with_valid_email_and_password()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $this->call('POST', route('auth.login'), [
            'email' => 'johndoe@example.com',
            'password' => 'secret123',
        ])->assertStatus(200);

        $this->assertEquals(true, auth()->check());
        $this->assertEquals($user->id, auth()->id());
    }

    /** @test */
    public function users_cannot_login_with_invalid_email_and_password()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $this->call('POST', route('auth.login'), [
            'email' => 'johndoe.invalid@example.com',
            'password' => 'secret123.invalid',
        ])->assertStatus(401);

        $this->assertEquals(false, auth()->check());
    }

}
