<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\UserResumeController
 */
class UploadResumeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;
    /**
     * @var UserProfile
     */
    private $profile;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->profile = factory(UserProfile::class)->create(['user_id' => $this->user->id]);
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function guest_users_can_not_upload_images()
    {
        $this->expectException(AuthenticationException::class);

        $this->postJson(route('resume.store', $this->user));
    }

    /** @test */
    public function authenticated_users_can_upload_profile_photos()
    {
        $this->signIn($this->user);

        Storage::fake('public');

        $this->postJson(route('resume.store', $this->user), [
            'resume' => $file = UploadedFile::fake()->create('resume.pdf', 150),
        ]);

        Storage::disk('public')->assertExists("{$this->user->id}/resume.pdf");

        $this->assertEquals("{$this->user->id}/resume.pdf", $this->profile->fresh()->resume);
    }
}
