<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\VolunteerOpportunity;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\CategoryController
 */
class ViewCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_view_a_category()
    {
        $this->withoutExceptionHandling();

        $category = factory(Category::class)->create();

        $opportunities = factory(VolunteerOpportunity::class, 10)->create(['category_id' => $category->id]);

        $this->get(route('category.show', $category))
            ->assertViewIs('category.show')
            ->assertViewHas('category', $category)
            ->assertViewHas('opportunities', function () use ($opportunities) {
                return $opportunities->contains($opportunities->first());
            });
    }
}
