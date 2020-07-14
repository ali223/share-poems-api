<?php
namespace Feature\Poems;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use TestCase;
use App\Poem;

class IndexTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_can_view_all_poems()
    {
        $poems = factory(Poem::class, 3)->create();

        $this->get(route('poems.index'))
            ->seeJson([
                'id' => $poems[0]->id,
                'title' => $poems[0]->title,
                'poetName' => $poems[0]->poet_name,
                'content' => $poems[0]->content,
                'imageUrl' => $poems[0]->image_url,
            ])
            ->seeJson([
                'id' => $poems[1]->id,
                'title' => $poems[1]->title,
                'poetName' => $poems[1]->poet_name,
                'content' => $poems[1]->content,
                'imageUrl' => $poems[1]->image_url,
            ])
            ->seeJson([
                'id' => $poems[2]->id,
                'title' => $poems[2]->title,
                'poetName' => $poems[2]->poet_name,
                'content' => $poems[2]->content,
                'imageUrl' => $poems[2]->image_url,
            ]);
    }
}
