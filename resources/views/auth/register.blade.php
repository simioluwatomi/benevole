@extends('layouts.auth')

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <a href="{{ route('index') }}" class="text-dark">
                            <h2 class="mt-0 mb-4">
                                {{ config('app.name', 'Laravel') }}
                            </h2>
                        </a>
                    </div>
                    <form class="card" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="card-body p-6">
                            <div class="card-title text-center text-uppercase">Create an account</div>
                            @if (session('message'))
                                <alert-component class="mb-3" type="{{ session('message.type') }}" title="{{ session('message.title') }}" body="{{ session('message.body') }}">
                                </alert-component>
                            @endif
                            <div class="form-group">
                                <select name="user_type" id="user-type"
                                        class="form-control custom-select @error('user_type') is-invalid @enderror"
                                        required
                                >
                                    <option value="" selected disabled hidden>I want to
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
                            <div class="form-group">
                                <label for="username" class="mb-1">
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
                            <div class="form-group">
                                <label for="email" class="mb-1">
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
                            <div class="form-group">
                                <label for="password" class="mb-1">
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
                            <div class="form-group">
                                <label for="password-confirm" class="mb-1">
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
                                <button type="submit"
                                        class="btn btn-primary btn-block">{{ __('Register') }}</button>
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
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#user-type').selectize({});
    </script>
@endpush
