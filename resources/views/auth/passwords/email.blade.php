@extends('layouts.auth')

@section('content')

    <div class="container-tight py-6">

        @include('partials.auth-logo')

        <form class="card card-md" action="{{ route('password.email') }}" method="POST">

            @csrf

            <div class="card-body">

                <h2 class="card-title text-center text-uppercase">Forgot Password&#63;</h2>

                @if (session('status'))
                    <alert-component variant="success" body="{{ session('status') }}">
                    </alert-component>
                @endif

                <p class="text-muted mb-4">
                    Enter your email address and a password reset link will be emailed to you.
                </p>

                <div class="form-group mb-5">

                    <label for="email" class="form-label">
                        {{ __('E-mail Address') }}
                        <span class="form-required">*</span>
                    </label>

                    <input type="email"
                           id="email"
                           name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           placeholder="Enter account email address"
                           required
                           autofocus
                    >

                    @error('email')
                    @include('partials.invalid-feedback')
                    @enderror

                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    {{ __('Send Password Reset Link') }}
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
