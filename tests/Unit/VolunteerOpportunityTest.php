<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\VolunteerOpportunity;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\VolunteerOpportunity
 */
class VolunteerOpportunityTest extends TestCase
{
    use RefreshDatabase;

    private $opportunity;
    /**
     * @var string
     */
    private $start_date;
    /**
     * @var string
     */
    private $end_date;

    protected function setUp(): void
    {
        parent::setUp();

        $this->opportunity = VolunteerOpportunity::create([
            'user_id'        => factory(User::class)->create()->id,
            'category_id'    => factory(Category::class)->create()->id,
            'title'          => 'This is a random title',
            'description'    => 'This is a random description',
            'hours_per_week' => 12,
            'start_date'     => $this->start_date = Carbon::today()->format('Y-m-d'),
            'end_date'       => $this->end_date = Carbon::tomorrow()->format('Y-m-d'),
        ]);
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
    public function it_has_a_slug()
    {
        $this->assertEquals(Str::slug($this->opportunity->title, '-'), $this->opportunity->slug);
    }

    /** @test */
    public function it_has_a_number_of_hours_per_week()
    {
        $this->assertEquals(12, $this->opportunity->hours_per_week);
    }

    /** @test */
    public function it_has_a_start_date()
    {
        $this->assertEquals($this->start_date, $this->opportunity->start_date->toDateString());
    }

    /** @test */
    public function it_has_an_end_date()
    {
        $this->assertEquals($this->end_date, $this->opportunity->end_date->toDateString());
    }
}
