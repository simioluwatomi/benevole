<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\Profile
 */
class ProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $profile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->profile = factory(Profile::class)->create();
    }

    /** @test */
    public function a_profile_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->profile->user);
    }
}
