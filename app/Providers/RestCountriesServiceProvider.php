<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Clients\RestCountriesClient;

class RestCountriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(RestCountriesClient::class, function () {
            return new RestCountriesClient([
                'base_uri' => 'https://restcountries.eu/rest/v2/all',
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
