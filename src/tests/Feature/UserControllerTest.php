<?php

namespace Tests\Feature;

use App\User;
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
        $res = $this->getJson(route('users.index'));

        $res->assertStatus(200);
    }

    /**
     * @covers \App\Http\Controllers\UserController::store
     *
     * @return void
     */
    public function testStore()
    {
        $password = $this->faker->word;
        $params   = [
            'name'                  => $this->faker->name,
            'email'                 => $this->faker->unique()->email,
            'password'              => $password,
        ];

        $res = $this->postJson(
            route('users.store'),
            $params
        );

        $res->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', Arr::except($params, ['password']));

        $resLogin = $this->postJson(
            route('auth.login'),
            [
                'email'    => $params['email'],
                'password' => $params['password'],
            ]
        );
        $resLogin->assertStatus(Response::HTTP_OK);
    }

    /**
     * @covers \App\Http\Controllers\UserController::show
     *
     * @return void
     */
    public function testShow()
    {
        $user = factory(User::class)->create();

        $res = $this->getJson(
            route('users.show', $user->id)
        );

        $res->assertStatus(Response::HTTP_OK);
        $res->assertJson($user->toArray());
    }

    /**
     * @covers \App\Http\Controllers\UserController::update
     *
     * @return void
     */
    public function testUpdate()
    {
        /** @var \App\User $user */
        $user = factory(User::class)->create();

        $password = $this->faker->word;
        $params = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->unique()->email,
            'password' => $password,
        ];

        $res = $this->putJson(
            route('users.update', ['user' => $user->id]),
            $params
        );

        $res->assertStatus(Response::HTTP_OK);
    }
}
