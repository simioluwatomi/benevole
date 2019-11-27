@extends('layouts.auth')

@section('content')
    <form method="POST" class="card bg-white form-auth" action="{{ route('register') }}">
        @csrf
        <div class="text-center card-header">
            <img class="mb-4" src="{{ asset('images/bootstrap-solid.svg') }}" alt="" width="50" height="50">
            <h3 class="font-weight-normal text-capitalize">Register an account</h3>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label for="userType" class="col-sm-3 col-form-label">I want to</label>
                <div class="col-sm-9">
                    <select class="selectpicker" title="Select user type" name="user_type">
                        <option value="volunteer" {{ old('user_type') == 'volunteer' ? 'selected' : '' }}>Become a
                            volunteer
                        </option>
                        <option value="organization" {{ old('user_type') == 'organization' ? 'selected' : '' }}>Engage
                            volunteers
                        </option>
                    </select>
                    @error('user_type')
                    @include('layouts.partials.invalid-feedback')
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label pr-0">{{ __('Username') }}</label>
                <div class="col-sm-9">
                    <input type="text"
                           id="username"
                           name="username"
                           class="form-control @error('username') is-invalid @enderror"
                           value="{{ old('username') }}"
                           placeholder="Enter username"
                           required
                           autofocus
                    >
                    @error('username')
                    @include('partials.invalid-feedback')
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">{{ __('E-mail') }}</label>
                <div class="col-sm-9">
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
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">{{ __('Password') }}</label>
                <div class="col-sm-9">
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
            </div>
            <div class="form-group row">
                <label for="password-confirm" class="col-sm-3 col-form-label">{{ __('Password') }}</label>
                <div class="col-sm-9">
                    <input type="password"
                           id="password-confirm"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Confirm Password"
                           required
                           autocomplete="new-password"
                    >
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>

            @if (Route::has('login'))
                <p class="mt-3 text-center">Already have an account&#63;
                    <a href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </p>
            @endif
        </div>
    </form>

@endsection
