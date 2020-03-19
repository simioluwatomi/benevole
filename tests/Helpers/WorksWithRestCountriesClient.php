<?php

namespace Tests\Helpers;

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use App\Http\Clients\RestCountriesClient;

trait WorksWithRestCountriesClient
{
    public function mockRestCountriesClient(): MockHandler
    {
        $mockHandler = new MockHandler();

        $client = new RestCountriesClient([
            'handler' => HandlerStack::create($mockHandler),
        ]);

        $this->app->instance(RestCountriesClient::class, $client);

        return $mockHandler;
    }

    public function mockSingleCountryResponse(): Response
    {
        return new Response(200, [], json_encode([
            [
                'name' => 'Afghanistan',
            ],
        ]));
    }
}
