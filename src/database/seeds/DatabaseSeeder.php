<?php

use Illuminate\Support\Facades\App;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 開発環境のみ発火する。
        if (App::environment('local')) {
            $this->call(UserSeeder::class);
            $this->call(PostSeeder::class);
        };
    }
}
