@extends('layouts.auth')

@section('content')
    <form method="POST" class="form-auth card bg-white" action="{{ route('login') }}">
        @csrf
        <div class="text-center card-header">
            <img class="mb-4" src="{{ asset('images/bootstrap-solid.svg') }}" alt="" width="50" height="50">
            <h3 class="font-weight-normal text-capitalize">Login to your account</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="email">{{ __('E-mail Address') }}</label>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       autocomplete="email"
                       placeholder="Enter email"
                       required
                       autofocus>
                @error('email')
                @include('partials.invalid-feedback')
                @enderror
            </div>
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Enter Password"
                       required
                       autocomplete="current-password">
                @error('password')
                @include('partials.invalid-feedback')
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <div class="flex-fill custom-control custom-checkbox mb-3">
                    <input type="checkbox"
                           name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}
                           class="custom-control-input">
                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
                @if (Route::has('password.request'))
                    <a class="flex-fill" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                @endif
            </div>
            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>

            @if (Route::has('register'))
                <p class="mt-3 text-center">Don&rsquo;t have an account&#63;
                    <a href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                </p>
            @endif
        </div>
    </form>
@endsection
