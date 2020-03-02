@extends('layouts.auth')

@section('content')

    @if (session('message'))
        <notification-component
            type="{{ session('message.type') }}"
            body="{{ session('message.body') }}"
            :timeout="5000"
        >
        </notification-component>
    @endif

    <div class="container-tight py-6">

       @include('partials.auth-logo')

        <form class="card card-md" action="{{ route('login') }}" method="POST">

            @csrf

            <div class="card-body">

                <h2 class="card-title mb-5 text-center text-uppercase">Login to your account</h2>

                <div class="form-group mb-3">

                    <label for="email" class="form-label">{{ __('E-mail or Username') }}</label>

                    <input
                        name="email"
                        id="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email address or username"
                        autocomplete="email"
                        autofocus
                        required
                        value="{{ old('email') }}"
                    >
                    @error('email')
                    @include('layouts.partials.invalid-feedback')
                    @enderror

                </div>

                <div class="form-group mb-3">

                    <label for="password" class="form-label">
                        {{ __('Password') }}

                        <a href="{{ route('password.request') }}"
                           class="float-right">{{ __('Forgot Your Password?') }}
                        </a>

                    </label>

                    <input name="password"
                           id="password"
                           type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required
                           autocomplete="current-password"
                           placeholder="Password"
                    >
                    @error('password')
                    @include('layouts.partials.invalid-feedback')
                    @enderror

                </div>

                <div class="form-group mb-3">

                    <label class="form-check" for="remember">

                        <input name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}
                               class="form-check-input"
                               type="checkbox"
                        >

                        <span class="form-check-label">
                            {{ __('Remember me on this device') }}
                        </span>

                    </label>

                </div>

                <div class="form-footer">

                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>

                </div>

            </div>

        </form>

        @if (Route::has('register'))
            <p class="mt-3 text-center text-muted">Don&rsquo;t have an account&#63;
                <a href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            </p>
        @endif

    </div>
@endsection
