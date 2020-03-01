<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use App\Models\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'country'           => $faker->country,
        'bio'               => $faker->sentence,
        'twitter_username'  => $faker->userName,
        'linkedin_username' => $faker->userName,
    ];
});
