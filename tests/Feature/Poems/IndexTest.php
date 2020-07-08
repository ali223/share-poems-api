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
                'poet_name' => $poems[0]->poet_name,
                'content' => $poems[0]->content,
                'image_url' => $poems[0]->image_url,
            ])
            ->seeJson([
                'id' => $poems[1]->id,
                'title' => $poems[1]->title,
                'poet_name' => $poems[1]->poet_name,
                'content' => $poems[1]->content,
                'image_url' => $poems[1]->image_url,
            ])
            ->seeJson([
                'id' => $poems[2]->id,
                'title' => $poems[2]->title,
                'poet_name' => $poems[2]->poet_name,
                'content' => $poems[2]->content,
                'image_url' => $poems[2]->image_url,
            ]);
    }
}
