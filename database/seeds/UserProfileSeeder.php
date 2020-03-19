<?php

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserProfileSeeder extends Seeder
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
            factory(UserProfile::class)->state('organization')->create(['user_id' => $org->id]);
        });

        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'volunteer');
        })->get();

        $users->each(function ($user) {
            factory(UserProfile::class)->state('volunteer')->create(['user_id' => $user->id]);
        });
    }
}
