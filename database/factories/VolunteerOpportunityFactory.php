<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Carbon\Carbon;
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
        'title'          => $faker->sentence,
        'description'    => $faker->paragraph,
        'hours_per_week' => $faker->randomDigitNotNull,
        'start_date'     => Carbon::today()->format('Y-m-d'),
        'end_date'       => Carbon::today()->addMonths(8)->format('Y-m-d'),
    ];
});
