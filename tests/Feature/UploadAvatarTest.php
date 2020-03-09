<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @internal
 *
 * @covers \App\Http\Controllers\UserAvatarController
 */
class UploadAvatarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function guest_users_can_not_upload_images()
    {
        $this->expectException(AuthenticationException::class);

        $this->postJson(route('avatar.store', $this->user));
    }

    /** @test */
    public function authenticated_users_can_upload_profile_photos()
    {
        $this->signIn($this->user);

        Storage::fake('public');

        $this->postJson(route('avatar.store', $this->user), [
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $hash = sha1($this->user->id);

        Storage::disk('public')->assertExists("{$this->user->id}/{$hash}.jpeg");

        $this->assertEquals("{$this->user->id}/{$hash}.jpeg", $this->user->fresh()->avatar);
    }
}
