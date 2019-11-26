@extends('layouts.auth')

@section('content')
    <form method="POST" class="form-auth card bg-white" action="{{ route('password.update') }}">
        @csrf
        <div class="text-center card-header">
            <img class="mb-4" src="{{ asset('images/bootstrap-solid.svg') }}" alt="" width="50" height="50">
            <h3 class="font-weight-normal text-capitalize">Reset password</h3>
        </div>
        <div class="card-body">
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">{{ __('E-mail') }}</label>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ $email ?? old('email') }}"
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
                       autocomplete="new-password">
                @error('password')
                @include('partials.invalid-feedback')
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input type="password"
                       id="password-confirm"
                       name="password_confirmation"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Re-enter Password"
                       required
                       autocomplete="new-password">
                @error('password')
                @include('partials.invalid-feedback')
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">{{ __('Reset Password') }}</button>
        </div>
    </form>
@endsection
