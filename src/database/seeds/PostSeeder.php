<?php

use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        for ($i = 0; $i <= rand(8, 12); $i++) {
            factory(Post::class)
                ->create([
                    'user_id' => $users->random(rand(1, 3))->pluck('id')->first()
                ]);
        }

        $posts = Post::all();

        factory(Tag::class, 10)
            ->create()
            ->each(function ($t) use ($posts) {
                $t->posts()->attach(
                    $posts->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
    }
}