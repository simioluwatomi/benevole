<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Collection;
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
            'role_id'               => factory(Role::class)->create()->id,
            'username'              => 'johndoe',
            'email'                 => 'johndoe@example.com',
            'telephone'             => $this->telephone,
            'password'              => bcrypt('password'),
            'email_verified_at'     => now(),
            'telephone_verified_at' => now()->addDay(),
        ]);

        factory(Profile::class)->create(['user_id' => $this->user->id]);
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
    public function a_user_has_a_telephone()
    {
        $this->assertEquals($this->telephone, $this->user->telephone);
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
    public function a_user_has_a_telephone_verified_at()
    {
        $this->assertInstanceOf(Carbon::class, $this->user->telephone_verified_at);
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
        $this->assertInstanceOf(Profile::class, $this->user->profile);
    }
}
