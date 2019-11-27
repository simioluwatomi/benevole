@extends('layouts.auth')

@section('content')
<form method="POST" class="form-auth card bg-white" action="{{ route('password.email') }}">
    @csrf
    <div class="text-center card-header">
        <img class="mb-4" src="{{ asset('images/bootstrap-solid.svg') }}" alt="" width="50" height="50">
        <h3 class="font-weight-normal text-capitalize">Reset password</h3>
    </div>
    <div class="card-body">

        @if (session('status'))
            <alert-component class="mb-3" type="success" body="{{ session('status') }}"></alert-component>
        @endif

        <div class="form-group">
            <label for="email">{{ __('E-mail Address') }}</label>
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

        <button type="submit" class="btn btn-twitter btn-block">{{ __('Send Password Reset Link') }}</button>

        @if (Route::has('login'))
            <p class="mt-3 text-center">Remember your password&#63;
                <a href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            </p>
        @endif

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
