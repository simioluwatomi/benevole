<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Collection;
use App\Models\OrganizationProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Models\User
 */
class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $user;
    private $telephone;

    protected function setUp(): void
    {
        parent::setUp();

        $this->telephone = $this->faker->e164PhoneNumber;

        $this->user = User::create([
            'role_id'           => factory(Role::class)->create()->id,
            'username'          => 'johndoe',
            'email'             => 'johndoe@example.com',
            'password'          => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        factory(UserProfile::class)->create(['user_id' => $this->user->id]);
        factory(OrganizationProfile::class)->create(['organization_id' => $this->user->id]);
    }

    /** @test */
    public function a_user_has_a_username()
    {
        $this->assertEquals('johndoe', $this->user->username);
    }

    /** @test */
    public function a_user_has_an_email()
    {
        $this->assertEquals('johndoe@example.com', $this->user->email);
    }

    /** @test */
    public function a_user_has_a_password()
    {
        $this->assertTrue(Hash::check('password', $this->user->password));
    }

    /** @test */
    public function a_user_has_an_email_verified_at()
    {
        $this->assertInstanceOf(Carbon::class, $this->user->email_verified_at);
    }

    /** @test */
    public function a_user_has_a_role()
    {
        $this->assertInstanceOf(Role::class, $this->user->role);
    }

    /** @test */
    public function a_user_creates_many_volunteer_opportunities()
    {
        $this->assertInstanceOf(Collection::class, $this->user->opportunities);
    }

    /** @test */
    public function a_user_has_a_profile()
    {
        $this->assertInstanceOf(UserProfile::class, $this->user->profile);
    }

    /** @test */
    public function a_user_has_an_organization_profile()
    {
        $this->assertInstanceOf(OrganizationProfile::class, $this->user->organization);
    }
}
