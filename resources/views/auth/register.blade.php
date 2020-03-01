@extends('layouts.auth')

@section('content')

    <div class="container-tight py-6">

        @include('partials.auth-logo')

        <form class="card card-md" action="{{ route('register') }}" method="POST">

            @csrf

            <div class="card-body">

                <h2 class="card-title text-center text-uppercase">Create an account</h2>

                @if (session('message'))
                    <alert-component variant="{{ session('message.type') }}"
                                     title="{{ session('message.title') }}"
                                     body="{{ session('message.body') }}">
                    </alert-component>
                @endif

                <div class="form-group mb-3">

                    <label class="form-label" for="user-type">
                        I want to
                        <span class="form-required">*</span>
                    </label>

                    <select name="user_type" id="user-type"
                            class="form-select @error('user_type') is-invalid @enderror"
                            required
                            autofocus
                    >
                        <option value="" selected disabled hidden>
                        </option>
                        <option
                            value="volunteer" {{ old('user_type') == 'volunteer' ? 'selected' : '' }}>
                            Become a volunteer
                        </option>
                        <option
                            value="organization" {{ old('user_type') == 'organization' ? 'selected' : '' }}>
                            Engage volunteers
                        </option>

                    </select>

                    @error('user_type')
                    @include('partials.invalid-feedback')
                    @enderror

                </div>

                <div class="form-group mb-3">

                    <label for="username" class="form-label">
                        {{ __('Username') }}
                        <span class="form-required">*</span>
                    </label>

                    <input type="text"
                           id="username"
                           name="username"
                           class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}"
                           placeholder="Enter username"
                           required
                    >

                    @error('username')
                    @include('partials.invalid-feedback')
                    @enderror

                </div>

                <div class="form-group mb-3">

                    <label for="email" class="form-label">
                        {{ __('E-mail') }}
                        <span class="form-required">*</span>
                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           placeholder="Enter email"
                           required
                    >

                    @error('email')
                    @include('partials.invalid-feedback')
                    @enderror

                </div>

                <div class="form-group mb-3">

                    <label for="password" class="form-label">
                        {{ __('Password') }}
                        <span class="form-required">*</span>
                    </label>

                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Enter Password"
                           autocomplete="new-password"
                           required
                    >

                    @error('password')
                    @include('partials.invalid-feedback')
                    @enderror

                </div>

                <div class="form-group mb-3">

                    <label for="password-confirm" class="form-label">
                        {{ __('Password Confirmation') }}
                        <span class="form-required">*</span>
                    </label>

                    <input type="password"
                           id="password-confirm"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Confirm Password"
                           autocomplete="new-password"
                           required
                    >

                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Register') }}
                    </button>
                </div>

            </div>

        </form>

        @if (Route::has('login'))
            <p class="mt-3 text-center text-muted">Already have an account&#63;
                <a href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </p>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#user-type').selectize({});
        });
    </script>
@endpush
