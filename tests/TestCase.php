<?php

namespace Tests;

use App\Models\User;
use JMac\Testing\Traits\HttpTestAssertions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use HttpTestAssertions;

    /**
     * @param null $user
     *
     * @return $this
     */
    protected function signIn($user = null)
    {
        $user = $user ?: factory(User::class)->create();

        $this->actingAs($user);

        return $this;
    }
}
