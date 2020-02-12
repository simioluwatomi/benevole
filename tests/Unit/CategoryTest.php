<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\Category
 */
class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Category|\Illuminate\Database\Eloquent\Model
     */
    private $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::create([
            'title' => 'This is a random title',
        ]);
    }

    /** @test */
    public function it_has_a_title()
    {
        $this->assertEquals('This is a random title', $this->category->title);
    }

    /** @test */
    public function it_has_a_slug()
    {
        $this->assertEquals(Str::slug($this->category->title, '-'), $this->category->slug);
    }

    /** @test */
    public function it_has_many_opportunities()
    {
        $this->assertInstanceOf(Collection::class, $this->category->opportunities);
    }
}
