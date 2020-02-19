@extends('master')

@section('content')

    <div class="row">

        <div class="col-md-8 mx-auto">

            <h3 class="mt-5 text-muted text-uppercase text-center">
                Post Volunteer Opportunity
            </h3>

            <hr>

            <b-form action="{{ route('opportunity.store') }}" method="POST">

                @csrf

                <b-form-group label-for="category-id" class="mb-3">

                    <template v-slot:label>
                        Category
                        <span class="form-required">*</span>
                    </template>

                    <select-component
                        input-id="category-id"
                        input-name="category_id"
                        :input-state="{{ $errors->has('category_id') ? 'false' : 'null' }}"
                        pre-selected="{{ old('category_id') }}"
                        :options='@json($categories)'
                        options-text="title"
                        placeholder="Select opportunity category"
                        :required="true"
                    ></select-component>

                    @error('category_id')
                    <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                    @enderror

                </b-form-group>

                <b-form-group label-for="title" class="mb-3">

                    <template v-slot:label>
                        Title
                        <span class="form-required">*</span>
                    </template>

                    <b-form-input
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        :state="{{ $errors->has('title') ? 'false' : 'null' }}"
                        required
                        placeholder="Enter opportunity title"
                    ></b-form-input>

                    @error('title')
                    <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                    @enderror

                </b-form-group>

                <b-form-group label-for="description" class="mb-3">

                    <template v-slot:label>
                        Description
                        <span class="form-required">*</span>
                    </template>

                    <b-form-textarea
                        id="description"
                        name="description"
                        value="{{ old('description') }}"
                        :state="{{ $errors->has('description') ? 'false' : 'null' }}"
                        required
                        placeholder="Describe the volunteer opportunity"
                        rows="5"
                        max-rows="15"
                    ></b-form-textarea>

                    @error('description')
                    <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                    @enderror

                </b-form-group>

                <b-form-group label-for="requirements" class="mb-3">

                    <template v-slot:label>
                        Requirements
                        <span class="form-required">*</span>
                    </template>

                    <input-component
                        input-name="requirements[]"
                        input-id="requirements"
                        :input-state="{{ $errors->has('requirements.0') ? 'false' : 'null' }}"
                        old-input="{{ old('requirements.0') }}"
                        :required="true"
                        placeholder="Enter opportunity requirements"
                    ></input-component>

                    @error('requirements.0')
                    <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                    @enderror

                </b-form-group>

                <add-form-input-component></add-form-input-component>

                <div class="row">

                    <b-form-group label-for="duration" class="col-md-4 mb-3">

                        <template v-slot:label>
                            Duration (months)
                            <span class="form-required">*</span>
                        </template>

                        <select-component
                            input-id="duration"
                            input-name="duration"
                            :input-state="{{ $errors->has('duration') ? 'false' : 'null' }}"
                            pre-selected="{{ old('duration') }}"
                            :options='@json(range(1, 12))'
                            placeholder="Select opportunity duration"
                            :required="true"
                        ></select-component>

                        @error('duration')
                        <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                        @enderror

                    </b-form-group>

                    <b-form-group label-for="min-hours-per-week" class="col-md-4 mb-3">

                        <template v-slot:label>
                            Min Hours Per Week
                            <span class="form-required">*</span>
                        </template>

                        <select-component
                            input-id="min-hours-per-week"
                            input-name="min_hours_per_week"
                            :input-state="{{ $errors->has('min_hours_per_week') ? 'false' : 'null' }}"
                            pre-selected="{{ old('min_hours_per_week') }}"
                            :options='@json(range(1, 8))'
                            placeholder="Select min hours per week"
                            :required="true"
                        ></select-component>

                        @error('min_hours_per_week')
                        <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                        @enderror

                    </b-form-group>

                    <b-form-group label-for="max-hours-per-week" class="col-md-4 mb-3">

                        <template v-slot:label>
                            Max Hours Per Week
                            <span class="form-required">*</span>
                        </template>

                        <select-component
                            input-id="max-hours-per-week"
                            input-name="max_hours_per_week"
                            :input-state="{{ $errors->has('max_hours_per_week') ? 'false' : 'null' }}"
                            pre-selected="{{ old('max_hours_per_week') }}"
                            :options='@json(range(1, 10))'
                            placeholder="Select max hours per week"
                            :required="true"
                        ></select-component>

                        @error('max_hours_per_week')
                        <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                        @enderror

                    </b-form-group>

                </div>

                <b-button variant="primary" type="submit" class="mt-3">Submit</b-button>

            </b-form>

        </div>

    </div>

@endsection
