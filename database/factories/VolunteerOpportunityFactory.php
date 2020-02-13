<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use App\Models\Category;
use Faker\Generator as Faker;
use App\Models\VolunteerOpportunity;

$factory->define(VolunteerOpportunity::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'title'              => $faker->sentence,
        'description'        => $faker->paragraph,
        'requirements'       => $faker->sentences,
        'min_hours_per_week' => $faker->numberBetween(1, 4),
        'max_hours_per_week' => $faker->numberBetween(5, 10),
        'duration'           => $faker->numberBetween(1, 12),
    ];
});
