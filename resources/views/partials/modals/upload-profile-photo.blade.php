<b-modal id="upload-profile-photo" centered title="Upload Profile Photo" size="lg" hide-footer>

    @include('partials.modal-header-close')

    <image-upload-component :user="{{ $user }}"></image-upload-component>

</b-modal>
