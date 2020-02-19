<?php

namespace App\Providers;

use App\Models\VolunteerOpportunity;
use App\Policies\VolunteerOpportunityPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        VolunteerOpportunity::class => VolunteerOpportunityPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
