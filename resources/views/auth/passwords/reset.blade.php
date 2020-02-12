@extends('layouts.auth')

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-md-4 mx-auto">
                    <div class="text-center mb-2">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('images/logo.svg') }}" class="h-9" alt="benevole logo">
                        </a>
                    </div>
                    <form class="card" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="card-body p-6">

                            <div class="card-title text-center text-uppercase">Reset Password</div>

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group">
                                <label for="email">{{ __('E-mail Address') }}</label>
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
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
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
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input type="password"
                                       id="password-confirm"
                                       name="password_confirmation"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Re-enter Password"
                                       required
                                       autocomplete="new-password"
                                >
                            </div>
                            <button type="submit"
                                    class="btn btn-twitter btn-block"
                            >
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
            </div>
        </div>
    </div>
@endsection
