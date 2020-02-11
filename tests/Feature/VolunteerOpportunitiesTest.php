<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\VolunteerOpportunity;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\VolunteerOpportunityController
 */
class VolunteerOpportunitiesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function all_visitors_can_see_the_latest_opportunities()
    {
        $this->withoutExceptionHandling();

        $opportunities = factory(VolunteerOpportunity::class, 30)->create();
        $latest = $opportunities->sortByDesc('created_at')->first();

        $categories = factory(Category::class, 15)->create();
        $names = $categories->pluck('title');

        $this->get(route('opportunity.index'))
            ->assertViewIs('opportunity.index')
            ->assertViewHas('categories', function ($categories) use ($names) {
                return $categories->contains($names->first());
            })
            ->assertViewHas('opportunities', function ($opportunities) use ($latest) {
                return $opportunities->contains($latest);
            });
    }

    /** @test */
    public function all_visitors_can_view_an_opportunity()
    {
        $this->withoutExceptionHandling();

        $opportunity = factory(VolunteerOpportunity::class)->create();

        $this->get(route('opportunity.show', ['user' => $opportunity->owner, 'volunteerOpportunity' => $opportunity]))
            ->assertViewIs('opportunity.show')
            ->assertSee($opportunity->title);
    }
}
