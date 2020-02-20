<?php

namespace Tests\Feature;

use URL;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\Auth\VerificationController
 */
class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create(['email_verified_at' => null]);
    }

    /** @test */
    public function guest_users_can_verify_email_address()
    {
        $this->withoutExceptionHandling();

        $this->get($this->verificationUrl($this->user));

        $this->assertTrue($this->user->fresh()->hasVerifiedEmail());
    }

    /** @test */
    public function authenticated_users_can_verify_email_address()
    {
        $this->withoutExceptionHandling();

        $this->actingAs($this->user);

        $this->get($this->verificationUrl($this->user));

        $this->assertTrue($this->user->fresh()->hasVerifiedEmail());
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param mixed $notifiable
     *
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire')),
            [
                'id'   => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
