<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
//        $this->call(RolesTableSeeder::class);

        $categories = factory(\App\Models\Category::class, 10)->create();

        $categories->each(function ($category) {
            factory(\App\Models\VolunteerOpportunity::class, 15)->create(['category_id' => $category->id]);
        });
    }
}
