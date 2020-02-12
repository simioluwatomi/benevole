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
 * @covers \App\Http\Controllers\HomeController
 */
class HomePageTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function home_page_visitors_can_see_the_latest_opportunities()
    {
        $this->withoutExceptionHandling();

        $opportunities = factory(VolunteerOpportunity::class, 30)->create();
        $latest = $opportunities->sortByDesc('created_at')->first();

        $this->get(route('index'))
            ->assertViewIs('index')
            ->assertViewHas('opportunities', function ($opportunities) use ($latest) {
                return $opportunities->contains($latest);
            });
    }

    /** @test */
    public function home_page_visitors_can_see_the_all_categories()
    {
        $this->withoutExceptionHandling();

        $categories = factory(Category::class, 15)->create()->loadCount('opportunities');
        $category = $categories->first();

        $this->get(route('index'))
            ->assertViewIs('index')
            ->assertViewHas('categories', function ($categories) use ($category) {
                return $categories->contains($category);
            });
    }
}
