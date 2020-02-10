<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
        'role_id' => function () {
            return factory(Role::class)->create()->id;
        },
        'username'              => $faker->userName,
        'email'                 => $faker->unique()->safeEmail,
        'telephone'             => $faker->unique()->phoneNumber,
        'email_verified_at'     => now(),
        'telephone_verified_at' => now(),
        'password'              => bcrypt('password'),
        'remember_token'        => Str::random(10),
    ];
});
