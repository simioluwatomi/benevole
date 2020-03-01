<?php

use App\Models\User;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $organizations = User::whereHas('role', function ($query) {
            $query->where('name', 'organization');
        })->get();

        $organizations->each(function ($org) {
            factory(Profile::class)->create(['user_id' => $org->id]);
        });
    }
}
