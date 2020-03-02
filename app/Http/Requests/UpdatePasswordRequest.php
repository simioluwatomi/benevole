<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdatePasswordRequest extends FormRequest
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
            'current_password'          => ['required', 'password'],
            'new_password'              => ['required', 'string', 'min:6', 'different:current_password'],
            'new_password_confirmation' => ['required', 'same:new_password'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'current_password.password' => 'The :attribute is incorrect',
        ];
    }

    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            session()->flash('password-modal-open', 'true');
        }

        return $validator;
    }
}
