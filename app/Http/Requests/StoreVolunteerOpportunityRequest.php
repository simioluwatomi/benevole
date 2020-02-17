<?php

namespace App\Http\Requests;

use App\Models\VolunteerOpportunity;
use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteerOpportunityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', VolunteerOpportunity::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'        => ['required'],
            'title'              => ['required'],
            'description'        => ['required'],
            'requirements'       => ['required', 'array'],
            'min_hours_per_week' => ['required'],
            'max_hours_per_week' => ['required'],
            'duration'           => ['required'],
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
            'category_id.required' => 'A category is required',
        ];
    }
}
