<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\OrganizationProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\OrganizationProfile
 */
class OrganizationProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Model|OrganizationProfile
     */
    private $profile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->profile = OrganizationProfile::create([
            'organization_id'   => factory(User::class)->create()->id,
            'organization_name' => 'Life of the Earth',
        ]);
    }

    /** @test */
    public function it_has_an_organization_name_attribute()
    {
        $this->assertEquals('Life of the Earth', $this->profile->organization_name);
    }

    /** @test */
    public function a_profile_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->profile->user);
    }
}
