<b-modal id="edit-profile-modal" centered title="Edit Profile" size="lg" hide-footer :visible="{{ session('profile-modal-open') ?? 'false' }}">

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

        <div class="row mb-md-3">
            <b-form-group label-for="first-name" class="col-md-6">

                <template v-slot:label>
                    First Name
                    <span class="form-required">*</span>
                </template>

                <b-form-input
                    id="first-name"
                    name="first_name"
                    value="{{ old('first_name', optional($user->profile)->first_name) }}"
                    :state="{{ $errors->has('first_name') ? 'false' : 'null' }}"
                    required
                    placeholder="Enter your first name"
                ></b-form-input>

                @error('first_name')
                <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                @enderror

            </b-form-group>

            <b-form-group label-for="last-name" class="col-md-6">

                <template v-slot:label>
                    Last Name
                    <span class="form-required">*</span>
                </template>

                <b-form-input
                    id="last-name"
                    name="last_name"
                    value="{{ old('last_name', optional($user->profile)->last_name) }}"
                    :state="{{ $errors->has('last_name') ? 'false' : 'null' }}"
                    required
                    placeholder="Enter your last name"
                ></b-form-input>

                @error('last_name')
                <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                @enderror

            </b-form-group>

        </div>

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

            <b-form-group label-for="twitter" label="Twitter" class="col-md-6">

                <b-input-group class="input-group-flat">

                    <b-input-group-text slot="prepend">
                        https://twitter.com/
                    </b-input-group-text>

                    <b-form-input
                        id="twitter"
                        name="twitter_username"
                        class="pl-0"
                        value="{{ old('twitter_username', optional($user->profile)->twitter_username) }}"
                        :state="{{ $errors->has('twitter_username') ? 'false' : 'null' }}"
                        placeholder="username"
                    ></b-form-input>

                </b-input-group>

                @error('twitter_username')
                <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                @enderror

            </b-form-group>

            <b-form-group label-for="linked-in" label="LinkedIn" class="col-md-6">

                <b-input-group class="input-group-flat">

                    <b-input-group-text slot="prepend">
                        https://www.linkedin.com/in/
                    </b-input-group-text>

                    <b-form-input
                        id="linked-in"
                        name="linkedin_username"
                        class="pl-0"
                        value="{{ old('linkedin_username', optional($user->profile)->linkedin_username) }}"
                        :state="{{ $errors->has('linkedin_username') ? 'false' : 'null' }}"
                        placeholder="username"
                    ></b-form-input>

                </b-input-group>

                @error('linkedin_username')
                <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
                @enderror

            </b-form-group>

        </div>

        <div class="row mb-md-3">

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
