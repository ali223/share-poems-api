<?php
namespace Feature\MyProfile;

use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function authenticated_users_can_view_their_profile()
    {
        $user = factory(User::class)->create();

        $token = JWTAuth::fromUser($user);

        $this->get(route('my-profile.index'), [
            'Authorization' => 'Bearer ' . $token
        ])
        ->seeJson([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /** @test */
    public function guests_cannot_view_their_profile()
    {
        $this->call('GET', route('my-profile.index'))
            ->assertStatus(401);
    }
}
