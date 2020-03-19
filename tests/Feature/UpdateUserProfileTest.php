<?php

namespace Tests\Feature;

use RoleSeeder;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\RestCountriesService;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\Helpers\WorksWithRestCountriesClient;
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
    use WorksWithRestCountriesClient;

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
        factory(UserProfile::class)->create(['user_id' => $this->volunteer->id]);
        factory(UserProfile::class)->create(['user_id' => $this->organization->id]);

        $mockHandler = $this->mockRestCountriesClient();
        app(RestCountriesService::class);
        $mockHandler->append($this->mockSingleCountryResponse());
    }

    /** @test */
    public function guest_users_can_not_see_form_to_edit_user_profile()
    {
        $this->get(route('volunteer.show', $this->volunteer))
            ->assertViewIs('user.volunteer')
            ->assertViewHas('user', $this->volunteer)
            ->assertDontSee('Edit Profile');

        $this->get(route('organization.show', $this->organization))
            ->assertViewIs('user.organization')
            ->assertViewHas('user', $this->organization)
            ->assertDontSee('Edit Profile');
    }

    /** @test */
    public function auth_users_can_not_see_form_to_edit_profile_of_other_users()
    {
        $this->actingAs(factory(User::class)->create());

        $this->get(route('volunteer.show', $this->volunteer))
            ->assertViewIs('user.volunteer')
            ->assertViewHas('user', $this->volunteer)
            ->assertDontSee('Edit Profile');

        $this->get(route('organization.show', $this->organization))
            ->assertViewIs('user.organization')
            ->assertViewHas('user', $this->organization)
            ->assertDontSee('Edit Profile');
    }

    /** @test */
    public function auth_volunteers_can_see_form_to_edit_their_profile()
    {
        $this->actingAs($this->volunteer);

        $this->get(route('volunteer.show', $this->volunteer))
            ->assertViewIs('user.volunteer')
            ->assertViewHas('user', $this->volunteer)
            ->assertSee('Edit Profile');
    }

    /** @test */
    public function auth_organizations_can_see_form_to_edit_their_profile()
    {
        $this->actingAs($this->organization);

        $this->get(route('organization.show', $this->organization))
            ->assertViewIs('user.organization')
            ->assertViewHas('user', $this->organization)
            ->assertSee('Edit Profile');
    }

    /** @test */
    public function guest_users_can_not_update_user_profile()
    {
        $this->withoutExceptionHandling();

        $this->expectException(AuthenticationException::class);

        $this->patch(route('user.update', $this->volunteer));
    }

    /** @test */
    public function auth_users_can_not_update_profile_of_other_users()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $this->expectException(AuthorizationException::class);

        $this->patch(route('user.update', $this->volunteer));
    }

    /** @test */
    public function auth_volunteers_can_update_their_profile()
    {
        $form = factory(UserProfile::class)->make()->toArray();

        $form = array_merge($form, [
            'username' => $this->faker->lastName,
            'email'    => $this->volunteer->email,
        ]);

        $this->actingAs($this->volunteer);

        $this->patch(route('user.update', $this->volunteer), $form);

        $this->assertEquals($this->volunteer->fresh()->username, $form['username']);
        $this->assertDatabaseHas('user_profiles', [
            'user_id'           => $this->volunteer->id,
            'first_name'        => toLowerCase($form['first_name']),
            'last_name'         => toLowerCase($form['last_name']),
            'country'           => $form['country'],
            'bio'               => $form['bio'],
            'organization_name' => $form['organization_name'],
            'website'           => $form['website'],
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
            'username' => $this->volunteer->username,
            'email'    => $this->faker->safeEmail,
        ]);

        $this->actingAs($this->volunteer);

        $this->patch(route('user.update', $this->volunteer), $form);

        $this->assertEquals($this->volunteer->fresh()->email, $form['email']);
        $this->assertEquals($this->volunteer->fresh()->email_verified_at, null);
        Notification::assertSentTo($this->volunteer, VerifyEmailQueued::class);
    }
}
