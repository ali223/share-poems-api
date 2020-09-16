<?php
namespace Feature\MyPoems;

use App\Poem;
use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_cannot_view_their_poems()
    {
        $this->call('GET', route('my-poems.index'))
            ->assertUnauthorized();
    }

    /** @test */
    public function authenticated_users_can_view_their_poems()
    {
        $user = factory(User::class)->create();

        $userPoems = factory(Poem::class, 2)->create([
            'user_id' => $user->id
        ]);

        $otherUserPoems = factory(Poem::class, 2)->create();

        $token = JWTAuth::fromUser($user);

        $this->get(route('my-poems.index'), [
            'Authorization' => 'Bearer ' . $token
        ])
        ->seeJson([
            'id' => $userPoems[0]->id,
            'title' => $userPoems[0]->title,
            'poetName' => $userPoems[0]->poet_name,
            'content' => $userPoems[0]->content,
            'imageUrl' => $userPoems[0]->image_url,
        ])
        ->seeJson([
            'id' => $userPoems[1]->id,
            'title' => $userPoems[1]->title,
            'poetName' => $userPoems[1]->poet_name,
            'content' => $userPoems[1]->content,
            'imageUrl' => $userPoems[1]->image_url,
        ])
        ->dontSeeJson([
            'id' => $otherUserPoems[0]->id,
            'title' => $otherUserPoems[0]->title,
            'poetName' => $otherUserPoems[0]->poet_name,
            'content' => $otherUserPoems[0]->content,
            'imageUrl' => $otherUserPoems[0]->image_url,
        ])
        ->dontSeeJson([
            'id' => $otherUserPoems[1]->id,
            'title' => $otherUserPoems[1]->title,
            'poetName' => $otherUserPoems[1]->poet_name,
            'content' => $otherUserPoems[1]->content,
            'imageUrl' => $otherUserPoems[1]->image_url,
        ]);
    }
}
