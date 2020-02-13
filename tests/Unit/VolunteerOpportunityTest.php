<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\VolunteerOpportunity;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\VolunteerOpportunity
 */
class VolunteerOpportunityTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $opportunity;
    /**
     * @var array|string
     */
    private $requirements;

    protected function setUp(): void
    {
        parent::setUp();

        $this->opportunity = VolunteerOpportunity::create([
            'user_id'            => factory(User::class)->create()->id,
            'category_id'        => factory(Category::class)->create()->id,
            'title'              => 'This is a random title',
            'description'        => 'This is a random description',
            'requirements'       => $this->requirements = $this->faker->sentences(4),
            'min_hours_per_week' => 3,
            'max_hours_per_week' => 12,
            'duration'           => 8,
        ]);
    }

    /** @test */
    public function it_has_a_title()
    {
        $this->assertEquals('This is a random title', $this->opportunity->title);
    }

    /** @test */
    public function it_has_a_description()
    {
        $this->assertEquals('This is a random description', $this->opportunity->description);
    }

    /** @test */
    public function it_has_requirements()
    {
        $this->assertEquals($this->requirements, $this->opportunity->requirements);
    }

    /** @test */
    public function it_has_a_slug()
    {
        $this->assertEquals(Str::slug($this->opportunity->title, '-'), $this->opportunity->slug);
    }

    /** @test */
    public function it_has_a_minimum_number_of_hours_per_week()
    {
        $this->assertEquals(3, $this->opportunity->min_hours_per_week);
    }

    /** @test */
    public function it_has_a_maximum_number_of_hours_per_week()
    {
        $this->assertEquals(12, $this->opportunity->max_hours_per_week);
    }

    /** @test */
    public function it_has_a_duration()
    {
        $this->assertEquals(8, $this->opportunity->duration);
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->opportunity->owner);
    }

    /** @test */
    public function it_belongs_to_a_category()
    {
        $this->assertInstanceOf(Category::class, $this->opportunity->category);
    }
}
