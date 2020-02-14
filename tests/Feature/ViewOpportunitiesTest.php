<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\VolunteerOpportunity;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\VolunteerOpportunityController
 */
class ViewOpportunitiesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function all_users_can_view_all_opportunities()
    {
        $this->withoutExceptionHandling();
        $opportunities = factory(VolunteerOpportunity::class, 40)->create();

        $this->get(route('opportunity.index'))
            ->assertViewIs('opportunity.index')
            ->assertViewHas('opportunities', function () use ($opportunities) {
                return $opportunities->contains($opportunities->first());
            });
    }

    /** @test */
    public function all_users_can_view_an_opportunity()
    {
        $this->withoutExceptionHandling();

        $opportunity = factory(VolunteerOpportunity::class)->create();

        $this->get(route('opportunity.show', $opportunity))
            ->assertViewIs('opportunity.show')
            ->assertViewHas('volunteerOpportunity', $opportunity);
    }
}
