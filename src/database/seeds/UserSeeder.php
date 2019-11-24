<?php

use App\User;
use App\UserProfile;
use App\Post;
use App\SnsAccount;
use App\Tag;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var App\User */
        factory(User::class, 10)->create()->each(function ($user) {
            $user->userProfile()->save(factory(UserProfile::class)->make());
            $user->snsAccounts()->save(factory(SnsAccount::class)->make());
        });
    }
}
