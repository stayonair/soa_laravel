<?php

namespace Tests\Feature;

use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @var \Faker\Generator */
    private $faker;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = app(Faker::class);
    }

    /**
     * A basic feature test example.
     *
     * @covers \App\Http\Controllers\UserController::index
     *
     * @return void
     */
    public function testIndex()
    {
        $res = $this->getJson(route('user_index'));

        $res->assertStatus(200);
    }

    public function testStore()
    {
        $password = $this->faker->word;
        $params   = [
            'name'                  => $this->faker->name,
            'email'                 => $this->faker->unique()->email,
            'password'              => $password,
        ];

        $res = $this->postJson(
            route('user_store'),
            $params
        );

        $res->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', Arr::except($params, ['password']));

        $resLogin = $this->postJson(
            route('auth_login'),
            [
                'email'    => $params['email'],
                'password' => $params['password'],
            ]
        );
        $resLogin->assertStatus(Response::HTTP_OK);
    }
}
