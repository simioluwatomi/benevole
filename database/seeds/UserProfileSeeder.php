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
        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'volunteer');
        })->get();

        $users->each(function ($user) {
            factory(UserProfile::class)->create(['user_id' => $user->id]);
        });
    }
}
