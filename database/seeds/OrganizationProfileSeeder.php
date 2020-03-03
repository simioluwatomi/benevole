<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\OrganizationProfile;

class OrganizationProfileSeeder extends Seeder
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
            factory(OrganizationProfile::class)->create(['organization_id' => $org->id]);
        });
    }
}
