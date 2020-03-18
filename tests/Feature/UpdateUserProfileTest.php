<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\UserProfileController
 */
class UpdateUserProfileTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->user = factory(User::class)->create();
        factory(UserProfile::class)->create(['user_id' => $this->user->id]);
    }

    /** @test */
    public function guest_users_can_not_see_form_to_edit_user_profile()
    {
        $this->get(route('volunteer.show', $this->user))
            ->assertViewIs('user.volunteer')
            ->assertViewHas('user', $this->user)
            ->assertDontSee('Edit Profile');
    }

    /** @test */
    public function auth_users_can_not_see_form_to_edit_profile_of_other_users()
    {
        $this->actingAs(factory(User::class)->create());

        $this->get(route('volunteer.show', $this->user))
            ->assertViewIs('user.volunteer')
            ->assertViewHas('user', $this->user)
            ->assertDontSee('Edit Profile');
    }

    /** @test */
    public function auth_users_can_see_form_to_edit_their_profile()
    {
        $this->actingAs($this->user);

        $this->get(route('volunteer.show', $this->user))
            ->assertViewIs('user.volunteer')
            ->assertViewHas('user', $this->user)
            ->assertSee('Edit Profile');
    }

    /** @test */
    public function guest_users_can_not_update_user_profile()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $this->patch(route('user.update', $this->user));
    }

    /** @test */
    public function auth_users_can_not_update_profile_of_other_users()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $this->expectException(AuthorizationException::class);

        $this->patch(route('user.update', $this->user));
    }

    /** @test */
    public function auth_users_can_update_their_profile()
    {
        $form = factory(UserProfile::class)->make()->toArray();

        $form = array_merge($form, [
            'username' => $this->faker->lastName,
            'email'    => $this->user->email,
        ]);

        $this->actingAs($this->user);

        $this->patch(route('user.update', $this->user), $form);

        $this->assertEquals($this->user->fresh()->username, $form['username']);
        $this->assertDatabaseHas('user_profiles', [
            'user_id'           => $this->user->id,
            'first_name'        => toLowerCase($form['first_name']),
            'last_name'         => toLowerCase($form['last_name']),
            'country'           => $form['country'],
            'bio'               => $form['bio'],
            'twitter_username'  => $form['twitter_username'],
            'linkedin_username' => $form['linkedin_username'],
        ]);
    }

    /** @test */
    public function changing_email_address_updates_email_verified_at_to_null_and_sends_email_verification_notification()
    {
        Notification::fake();
        $form = factory(UserProfile::class)->make()->toArray();

        $form = array_merge($form, [
            'username' => $this->user->username,
            'email'    => $this->faker->safeEmail,
        ]);

        $this->actingAs($this->user);

        $this->patch(route('user.update', $this->user), $form);

        $this->assertEquals($this->user->fresh()->email, $form['email']);
        $this->assertEquals($this->user->fresh()->email_verified_at, null);
        Notification::assertSentTo($this->user, VerifyEmailQueued::class);
    }
}
