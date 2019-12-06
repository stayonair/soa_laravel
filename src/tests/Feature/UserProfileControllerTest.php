<?php

namespace Tests\Feature;

use App\User;
use App\UserProfile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProfileControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUpdate()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        /** @var UserProfile $profile */
        $profile = factory(UserProfile::class)->make();
        $user->userProfile()->save($profile);

        $params = [
            'name' => $this->faker->name,
            'introduction' => $this->faker->sentence,
        ];

        $response = $this->patchJson(route('user_profile.update', ['user' => $user]), $params);

        $response->assertStatus(200);

        $this->assertDatabaseHas('user_profiles', ['user_id' => $user->id] + $params);
    }
}
