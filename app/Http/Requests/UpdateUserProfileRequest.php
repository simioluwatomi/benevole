<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->route('user'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'          => ['required', 'alpha_dash', 'max:255', Rule::unique('users')->ignore(auth()->id())],
            'email'             => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
            'first_name'        => ['required', 'string', 'max:60', 'not_regex:/\s/'],
            'last_name'         => ['required', 'string', 'max:60', 'not_regex:/\s/'],
            'country'           => ['required', 'string', 'max:48'],
            'bio'               => ['nullable', 'string', 'max:200'],
            'twitter_username'  => ['nullable', 'string', 'max:60'],
            'linkedin_username' => ['nullable', 'string', 'max:60'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            '*.not_regex' => 'The :attribute field should not contain spaces.',
        ];
    }

    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            session()->flash('profile-modal-open', 'true');
        }

        return $validator;
    }
}
