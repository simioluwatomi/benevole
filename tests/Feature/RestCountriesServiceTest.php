<?php

namespace Tests\Feature;

use Tests\TestCase;
use GuzzleHttp\Handler\MockHandler;
use App\Services\RestCountriesService;
use Tests\Helpers\WorksWithRestCountriesClient;

/**
 * @internal
 *
 * @covers \App\Services\RestCountriesService
 */
class RestCountriesServiceTest extends TestCase
{
    use WorksWithRestCountriesClient;

    /**
     * @var RestCountriesService
     */
    private $restCountriesService;

    /**
     * @var MockHandler
     */
    private $mockHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockHandler = $this->mockRestCountriesClient();

        $this->restCountriesService = app(RestCountriesService::class);
    }

    /** @test */
    public function it_fetches_countries_filtered_by_name()
    {
        $this->mockHandler->append($this->mockSingleCountryResponse());

        $results = $this->restCountriesService->filterCountriesByParameter('name');

        $this->assertCount(1, $results);
        $this->assertEquals('Afghanistan', $results[0]['name']);
    }
}
