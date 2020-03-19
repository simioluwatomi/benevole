<?php

namespace Tests\Feature;

use RoleSeeder;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\Auth\RegisterController
 */
class RegisterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->seed(RoleSeeder::class);
    }

    /** @test */
    public function authenticated_users_can_not_visit_the_login_route()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $this->get(route('register'))->assertRedirect();
    }

    /** @test */
    public function users_are_not_logged_in_after_registration()
    {
        $this->withoutExceptionHandling();

        $form = [
            'user_type'              => 'volunteer',
            'username'               => 'username',
            'email'                  => $this->faker->unique()->safeEmail,
            'organization_name'      => $this->faker->company,
            'password'               => 'password',
            'password_confirmation'  => 'password',
        ];

        $this->post('/register', $form)->assertSessionHas('message');

        $user = User::whereUsername($form['username'])->firstOrFail();

        $this->assertDatabaseHas('users', ['username' => $form['username'], 'email' => $form['email']]);

        $this->assertDatabaseHas('user_profiles', ['user_id' => $user->id]);

        $this->assertGuest();
    }

    /** @test */
    public function email_verification_notification_is_sent_when_the_registered_event_is_fired()
    {
        $this->withoutExceptionHandling();
        Notification::fake();

        $user = factory(User::class)->create(['email_verified_at' => null]);

        (new SendEmailVerificationNotification())->handle(new Registered($user));

        Notification::assertSentTo($user, VerifyEmailQueued::class);
    }
}
