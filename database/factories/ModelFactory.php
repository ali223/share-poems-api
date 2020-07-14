<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Poem;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => Hash::make(Str::random(20)),
    ];
});

$factory->define(Poem::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'poet_name' => $faker->name,
        'content' => $faker->paragraphs(5, true),
        'image_url' => $faker->imageUrl,
        'user_id' => factory(User::class)->create()->id,
    ];
});
