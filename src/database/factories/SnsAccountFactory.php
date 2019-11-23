<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SnsAccount;
use Faker\Generator as Faker;

$factory->define(SnsAccount::class, function (Faker $faker) {
    return [
        'sns_type' => 'twitter',
        'account_id' => $faker->userName,
    ];
});
