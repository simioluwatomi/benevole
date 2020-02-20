<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\VolunteerOpportunity;

class VolunteerOpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $organizations = User::whereHas('role', function ($query) {
            $query->where('name', 'organization');
        })->get();

        Category::all()->each(function ($category) use ($organizations) {
            factory(VolunteerOpportunity::class, 15)->create(['category_id' => $category->id, 'user_id' => $organizations->random()->id]);
        });
    }
}
