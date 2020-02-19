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
            'title'              => ['required', 'min:8'],
            'description'        => ['required', 'min:15'],
            'requirements'       => ['required', 'array'],
            'requirements.*'     => ['required', 'string', 'distinct', 'min:5'],
            'min_hours_per_week' => ['required', 'between:1,8', 'lt:max_hours_per_week'],
            'max_hours_per_week' => ['required', 'between:1,10', 'gt:min_hours_per_week'],
            'duration'           => ['required', 'max:12'],
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
            'category_id.required'    => 'The category is required.',
            'requirements.*.required' => 'The requirements field is required.',
            'requirements.*.string'   => 'The requirements field must be a string.',
            'requirements.*.distinct' => 'The requirements field has a duplicate value.',
            'requirements.*.min'      => 'The requirements field must be at least :min characters.',
            'min_hours_per_week.lt'   => 'The :attribute must be less than the max hours per week',
            'max_hours_per_week.gt'   => 'The :attribute must be greater than the min hours per week',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'duration'           => (int) $this->input('duration'),
            'min_hours_per_week' => (int) $this->input('min_hours_per_week'),
            'max_hours_per_week' => (int) $this->input('max_hours_per_week'),
        ]);
    }
}
