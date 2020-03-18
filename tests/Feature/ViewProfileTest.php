<?php

namespace Tests\Feature;

use RoleSeeder;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\UserProfileController
 */
class ViewProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|User
     */
    private $volunteer;
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|User
     */
    private $organization;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->seed(RoleSeeder::class);

        $this->volunteer = factory(User::class)->create(['role_id' => Role::whereName('volunteer')->first()->id]);
        $this->organization = factory(User::class)->create(['role_id' => Role::whereName('organization')->first()->id]);
    }

    /** @test */
    public function guests_can_view_any_profile()
    {
        $this->get(route('volunteer.show', $this->volunteer))
            ->assertViewIs('user.volunteer')
            ->assertViewHas('user', $this->volunteer);

        $this->get(route('organization.show', $this->organization))
            ->assertViewIs('user.organization')
            ->assertViewHas('user', $this->organization);
    }

    /** @test */
    public function authenticated_users_can_view_the_profile_of_other_users()
    {
        $this->actingAs(factory(User::class)->create());

        $this->get(route('volunteer.show', $this->volunteer))
            ->assertViewIs('user.volunteer')
            ->assertViewHas('user', $this->volunteer);

        $this->get(route('organization.show', $this->organization))
            ->assertViewIs('user.organization')
            ->assertViewHas('user', $this->organization);
    }
}
