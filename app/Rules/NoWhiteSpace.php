<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoWhiteSpace implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !preg_match('/\s/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field should not contain spaces.';
    }
}
