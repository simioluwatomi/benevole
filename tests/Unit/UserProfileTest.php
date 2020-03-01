<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\UserProfile
 */
class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var UserProfile
     */
    private $profile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->profile = UserProfile::create([
            'user_id'           => factory(User::class)->create()->id,
            'first_name'        => 'John',
            'last_name'         => 'Doe',
            'country'           => 'Nigeria',
            'bio'               => 'This is a short bio',
            'twitter_username'  => 'randomtwitter',
            'linkedin_username' => 'randomlinkedin',
        ]);
    }

    /** @test */
    public function it_has_a_first_name_attribute()
    {
        $this->assertEquals('John', $this->profile->first_name);
    }

    /** @test */
    public function it_has_a_last_name_attribute()
    {
        $this->assertEquals('Doe', $this->profile->last_name);
    }

    /** @test */
    public function it_has_a_full_name_attribute()
    {
        $this->assertEquals('John Doe', $this->profile->full_name);
    }

    /** @test */
    public function it_has_a_country_attribute()
    {
        $this->assertEquals('Nigeria', $this->profile->country);
    }

    /** @test */
    public function it_has_a_bio_attribute()
    {
        $this->assertEquals('This is a short bio', $this->profile->bio);
    }

    /** @test */
    public function it_has_a_twitter_username_attribute()
    {
        $this->assertEquals('randomtwitter', $this->profile->twitter_username);
    }

    /** @test */
    public function it_has_a_twitter_profile_attribute()
    {
        $this->assertEquals('https://twitter.com/randomtwitter', $this->profile->twitter_profile);
    }

    /** @test */
    public function it_has_a_linkedin_username_attribute()
    {
        $this->assertEquals('randomlinkedin', $this->profile->linkedin_username);
    }

    /** @test */
    public function it_has_a_linked_in_profile_attribute()
    {
        $this->assertEquals('https://www.linkedin.com/in/randomlinkedin', $this->profile->linked_in_profile);
    }

    /** @test */
    public function a_profile_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->profile->user);
    }
}
