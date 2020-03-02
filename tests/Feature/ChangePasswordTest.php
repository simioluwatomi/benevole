<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PasswordChangeSuccessful;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\UserPasswordController
 */
class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;
    /**
     * @var array
     */
    private $form;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->user = factory(User::class)->create();
        $this->form = [
            'current_password'          => 'password',
            'new_password'              => 'secret',
            'new_password_confirmation' => 'secret',
        ];
    }

    /** @test */
    public function guest_users_can_not_update_password()
    {
        $this->expectException(AuthenticationException::class);
        $this->patch(route('password.update', $this->user));
    }

    /** @test */
    public function unverified_users_can_not_update_their_password()
    {
        $this->user->update(['email_verified_at' => null]);
        $this->actingAs($this->user);

        $this->patch(route('password.update', $this->user));

        $this->assertFalse(Hash::check('secret', $this->user->fresh()->password));
    }

    /** @test */
    public function users_can_not_change_the_password_of_others()
    {
        $this->expectException(AuthorizationException::class);

        $this->signIn();

        $this->patch(route('password.update', $this->user), $this->form);
    }

    /** @test */
    public function verified_users_can_change_their_password()
    {
        $this->signIn($this->user);

        $this->patch(route('password.update', $this->user), $this->form);

        $this->assertGuest();

        $this->assertTrue(Hash::check('secret', $this->user->fresh()->password));
    }

    /** @test */
    public function it_sends_a_notification_after_a_successful_password_change()
    {
        Notification::fake();

        $this->signIn($this->user);

        $this->patch(route('password.update', $this->user), $this->form);

        Notification::assertSentTo($this->user, PasswordChangeSuccessful::class);
    }
}
