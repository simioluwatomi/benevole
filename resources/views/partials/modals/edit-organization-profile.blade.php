<b-modal id="edit-profile-modal" centered title="Edit Profile" size="lg" hide-footer
         :visible="{{ session('profile-modal-open') ?? 'false' }}">

    @include('partials.modal-header-close')

    <b-form action="{{ route('user.update', $user) }}" method="POST">

        @method('PATCH')

        @csrf

        <div class="row mb-md-3">

            <b-form-group label-for="email" class="col-md-6">

                <template v-slot:label>
                    Email
                    <span class="form-required">*</span>
                </template>

                <div class="d-flex">

                    <b-form-input
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        :state="{{ $errors->has('email') ? 'false' : 'null' }}"
                        required
                        placeholder="Enter email address"
                        type="email"
                    ></b-form-input>

                    <div class="col-auto align-self-center">
                        <span
                            v-b-popover.click.top="`Changing e-mail address will trigger e-mail verification.`"
                            class="form-help" aria-describedby="popover143162">?</span>
                    </div>

                </div>

                @error('email')
                <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                @enderror

            </b-form-group>

            <b-form-group label-for="username" class="col-md-6">

                <template v-slot:label>
                    Username
                    <span class="form-required">*</span>
                </template>

                <b-form-input
                    id="username"
                    name="username"
                    value="{{ old('username', $user->username) }}"
                    :state="{{ $errors->has('username') ? 'false' : 'null' }}"
                    required
                    placeholder="Enter account username"
                ></b-form-input>

                @error('username')
                <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                @enderror

            </b-form-group>

        </div>

        <b-form-group label-for="organization-name" class="mb-3">

            <template v-slot:label>
                Organization Name
                <span class="form-required">*</span>
            </template>

            <b-form-input
                id="organization-name"
                name="organization_name"
                value="{{ old('organization_name', optional($user->profile)->organization_name) }}"
                :state="{{ $errors->has('organization_name') ? 'false' : 'null' }}"
                required
                placeholder="Enter organization name"
            ></b-form-input>

            @error('organization_name')
            <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
            @enderror

        </b-form-group>


        <b-form-group label-for="bio" label="Bio" class="mb-3">

            <b-form-textarea
                id="bio"
                name="bio"
                value="{{ old('bio', optional($user->profile)->bio) }}"
                :state="{{ $errors->has('bio') ? 'false' : 'null' }}"
                required
                placeholder="Add your bio"
                rows="4"
                max-rows="15"
                maxlength="200"
            ></b-form-textarea>

            @error('bio')
            <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
            @enderror

        </b-form-group>

        <div class="row mb-md-3">

            <b-form-group label-for="website" label="Website" class="col-md-6">

                <b-form-input
                    id="website"
                    name="website"
                    value="{{ old('website', optional($user->profile)->website) }}"
                    :state="{{ $errors->has('website') ? 'false' : 'null' }}"
                    placeholder="Enter organization's website"
                ></b-form-input>

                @error('website')
                <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                @enderror

            </b-form-group>


            <b-form-group label-for="country" class="col-md-6">

                <template v-slot:label>
                    Country
                    <span class="form-required">*</span>
                </template>

                <select-component
                    input-id="country"
                    input-name="country"
                    :input-state="{{ $errors->has('country') ? 'false' : 'null' }}"
                    pre-selected="{{ old('country', optional($user->profile)->country) }}"
                    :options='@json($countries)'
                    placeholder="Select country you are located"
                    options-text="name"
                    options-identifier="name"
                    :required="true"
                ></select-component>

                @error('country')
                <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                @enderror

            </b-form-group>

        </div>

        <div class="btn-list float-right my-4">

            <b-button variant="secondary" @click="$bvModal.hide('edit-profile-modal')">Cancel</b-button>

            <b-button type="submit" variant="primary">Update Profile</b-button>

        </div>

    </b-form>

</b-modal>
