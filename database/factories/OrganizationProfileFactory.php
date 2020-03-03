<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use App\Models\OrganizationProfile;

$factory->define(OrganizationProfile::class, function (Faker $faker) {
    return [
        'organization_id' => function () {
            return factory(User::class)->create()->id;
        },
        'organization_name' => $faker->company,
    ];
});
