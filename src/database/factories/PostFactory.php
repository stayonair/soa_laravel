<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 20, $indexSize = 1),
        'article' => $faker->sentence,
        'audio_url' => $faker->url,
        'thumbnail_url' => $faker->url,
    ];
});
