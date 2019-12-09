<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Advancer;
use App\Department;
use Faker\Generator as Faker;

$factory->define(Advancer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->unique()->phoneNumber,
        'dept' => rand(1,2),
    ];
});
