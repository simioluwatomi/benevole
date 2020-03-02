<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\Auth\RegisterController;

/**
 * @internal
 *
 * @covers \App\Http\Requests\RegisterUserRequest
 */
class RegisterUserRequestTest extends TestCase
{
    /**
     * @var RegisterUserRequest
     */
    private $formRequest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->formRequest = new RegisterUserRequest();
    }

    /** @test */
    public function it_has_the_correct_validation_rules()
    {
        $this->assertValidationRules([
            'user_type'         => ['required', 'string'],
            'organization_name' => ['required_if:user_type,organization'],
            'username'          => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:6', 'confirmed'],
        ], $this->formRequest->rules());
    }

    /** @test */
    public function it_is_being_used_by_the_appropriate_controller_action()
    {
        $this->assertActionUsesFormRequest(
            RegisterController::class,
            'register',
            get_class($this->formRequest)
        );
    }

    /** @test */
    public function user_making_the_request_is_authorized()
    {
        $this->assertTrue($this->formRequest->authorize());
    }
}
