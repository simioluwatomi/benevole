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
        'bio'               => $faker->text(180),
        'country'           => $faker->country,
    ];
});

$factory->state(UserProfile::class, 'volunteer', function ($faker) {
    return [
        'first_name'        => $faker->firstName,
        'last_name'         => $faker->lastName,
        'twitter_username'  => $faker->userName,
        'linkedin_username' => $faker->userName,
    ];
});

$factory->state(UserProfile::class, 'organization', function ($faker) {
    return [
        'organization_name' => $faker->company,
        'website'           => $faker->url,
    ];
});
