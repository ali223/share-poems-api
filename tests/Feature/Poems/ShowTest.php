<?php
namespace Feature\Poems;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;
use App\Poem;

class ShowTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_can_view_a_single_poem()
    {
        $poem = factory(Poem::class)->create();

        $this->get(route('poems.show', ['id' => $poem->id]))
            ->seeJson([
                'id' => $poem->id,
                'title' => $poem->title,
                'poetName' => $poem->poet_name,
                'content' => $poem->content,
                'imageUrl' => $poem->image_url,
            ]);
    }
}
