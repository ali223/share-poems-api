<?php

use Illuminate\Database\Seeder;
use App\Poem;

class PoemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Poem::class, 10)->create();
    }
}
