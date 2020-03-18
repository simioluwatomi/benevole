<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Http\Clients\RestCountriesClient;

class RestCountriesService
{
    /**
     * @var RestCountriesClient
     */
    private $client;
    /**
     * @var float|int
     */
    private $ttl;

    /**
     * RestCountriesService constructor.
     *
     * @param RestCountriesClient $client
     */
    public function __construct(RestCountriesClient $client)
    {
        $this->client = $client;
        $this->ttl = 60 * 60 * 24 * 30;
    }

    public function filterCountriesByParameter($param)
    {
        return Cache::remember('countries', $this->ttl, function () use ($param) {
            $response = $this->client->get("?fields={$param}");

            return collect(json_decode($response->getBody(), true));
        });
    }
}
