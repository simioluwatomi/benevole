<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = Role::all();

        $roles->each(function ($role) {
            factory(User::class, 15)->create(['role_id' => $role->id]);
        });
    }
}
