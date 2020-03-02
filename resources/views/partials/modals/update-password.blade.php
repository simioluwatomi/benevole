<b-modal id="update-password-modal" centered title="Update Password" hide-footer :visible="{{ session('password-modal-open') ?? 'false' }}">

    <template v-slot:modal-header-close>

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
             class="icon icon-md">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>

    </template>

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

            <button type="submit" class="btn btn-primary">Update Password</button>

        </div>

    </b-form>

</b-modal>
