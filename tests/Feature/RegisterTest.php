<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use RolesTableSeeder;
use Illuminate\Auth\Events\Registered;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

/**
 * @internal
 *
 * @coversNothing
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
        $this->seed(RolesTableSeeder::class);
    }

    /** @test */
    public function authenticated_users_can_not_visit_the_login_route()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $this->get(route('register'))->assertRedirect();
    }

    /** @test */
    public function guest_users_are_sent_verification_email_but_are_not_logged_in_after_registration()
    {
        $this->withoutExceptionHandling();

        $form = [
            'user_type'              => $this->faker->randomElement(['volunteer', 'organization']),
            'username'               => $this->faker->unique()->userName,
            'email'                  => $this->faker->unique()->safeEmail,
            'password'               => 'password',
            'password_confirmation'  => 'password',
        ];

        $this->post('/register', $form)->assertSessionHas('message');

        $this->assertDatabaseHas('users', ['username' => $form['username'], 'email' => $form['email']]);

        $this->assertGuest();
    }

    /** @test */
    public function email_verification_notification_is_sent_to_users()
    {
        $this->withoutExceptionHandling();
        Notification::fake();

        $user = factory(User::class)->create(['email_verified_at' => null]);

        (new SendEmailVerificationNotification())->handle(new Registered($user));

        Notification::assertSentTo($user, VerifyEmailQueued::class);
    }
}
