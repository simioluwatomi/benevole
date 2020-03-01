<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\UserProfileController
 */
class ViewUserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_view_any_profile()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->get(route('user.show', $user))
            ->assertViewIs('user.show')
            ->assertViewHas('user', $user);
    }

    /** @test */
    public function users_can_view_the_profile_of_other_users()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->actingAs(factory(User::class)->create());

        $this->get(route('user.show', $user))
            ->assertViewIs('user.show')
            ->assertViewHas('user', $user);
    }
}
