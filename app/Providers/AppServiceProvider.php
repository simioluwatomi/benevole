<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Route::bind('organization', function ($value) {
            return User::whereUsername($value)->whereHas('role', function ($query) {
                $query->where('name', 'organization');
            })->firstOrFail();
        });

        Route::bind('volunteer', function ($value) {
            return User::whereUsername($value)->whereHas('role', function ($query) {
                $query->where('name', 'volunteer');
            })->firstOrFail();
        });
    }
}
