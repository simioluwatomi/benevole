<b-modal id="update-password-modal" centered title="Update Password" hide-footer :visible="{{ session('password-modal-open') ?? 'false' }}">

    @include('partials.modal-header-close')

    <b-alert show variant="info">You will be logged out after a successful password change.</b-alert>

    <b-form action="{{ route('password.update', $user) }}" method="POST">

        @method('PATCH')

        @csrf

        <b-form-group label-for="current-password" class="mb-3">

            <template v-slot:label>
                Current Password
                <span class="form-required">*</span>
            </template>

            <b-form-input
                id="current-password"
                name="current_password"
                :state="{{ $errors->has('current_password') ? 'false' : 'null' }}"
                required
                placeholder="Enter current password"
                type="password"
            ></b-form-input>

            @error('current_password')
            <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
            @enderror

        </b-form-group>

        <b-form-group label-for="password" class="mb-3">

            <template v-slot:label>
                New Password
                <span class="form-required">*</span>
            </template>

            <b-form-input
                id="password"
                name="new_password"
                :state="{{ $errors->has('new_password') ? 'false' : 'null' }}"
                required
                placeholder="Enter new password"
                type="password"
            ></b-form-input>

            @error('new_password')
            <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
            @enderror

        </b-form-group>

        <b-form-group label-for="password-confirm" class="mb-3">

            <template v-slot:label>
                New Password Confirmation
                <span class="form-required">*</span>
            </template>

            <b-form-input
                id="password-confirm"
                name="new_password_confirmation"
                :state="{{ $errors->has('new_password_confirmation') ? 'false' : 'null' }}"
                required
                placeholder="Confirm new password"
                type="password"
            ></b-form-input>

            @error('new_password_confirmation')
            <invalid-feedback-component message="{{ $message }}"></invalid-feedback-component>
            @enderror

        </b-form-group>

        <div class="btn-list float-right my-4">

            <b-button variant="secondary" @click="$bvModal.hide('update-password-modal')">Cancel</b-button>

            <b-button type="submit" variant="primary">Update Password</b-button>

        </div>

    </b-form>

</b-modal>
