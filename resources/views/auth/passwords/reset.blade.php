@extends('layouts.auth')

@section('content')

    <div class="container-tight py-6">

        @include('partials.auth-logo')

        <form class="card card-md" action="{{ route('password.update') }}" method="POST">

            @csrf

            <div class="card-body">

                <h2 class="card-title text-center text-uppercase">Reset Password</h2>

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group mb-3">

                    <label for="email" class="form-label">
                        {{ __('E-mail Address') }}

                        <span class="form-required">*</span>

                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ $email ?? old('email') }}"
                           autocomplete="email"
                           placeholder="Enter account email address"
                           required
                           autofocus
                           readonly
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
                           required
                           autocomplete="new-password"
                    >

                    @error('password')
                    @include('partials.invalid-feedback')
                    @enderror

                </div>

                <div class="form-group mb-3">

                    <label for="password-confirm" class="form-label">
                        {{ __('Confirm Password') }}

                        <span class="form-required">*</span>

                    </label>

                    <input type="password"
                           id="password-confirm"
                           name="password_confirmation"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Re-enter Password"
                           required
                           autocomplete="new-password"
                    >

                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Reset Password') }}
                </button>

            </div>

        </form>

        @if (Route::has('login'))
            <p class="mt-3 text-center text-muted">Remember your password&#63;
                <a href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </p>
        @endif

        @if (Route::has('register'))
            <p class="mt-3 text-center text-muted">Don&rsquo;t have an account&#63;
                <a href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            </p>
        @endif

    </div>

@endsection
