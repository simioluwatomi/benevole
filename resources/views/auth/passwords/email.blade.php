@extends('layouts.auth')

@section('content')
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col col-login mx-auto">
                    <div class="text-center mb-6">
                        <a href="{{ route('opportunity.index') }}" class="text-dark">
                            <h2 class="mt-0 mb-4">
                                {{ config('app.name', 'Laravel') }}
                            </h2>
                        </a>
                    </div>
                    <form class="card" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="card-body p-6">

                            <div class="card-title text-center text-uppercase">Forgot Password&#63;</div>

                            @if (session('status'))
                                <alert-component class="mb-3" type="success" body="{{ session('status') }}">
                                </alert-component>
                            @endif

                            <p class="text-muted mb-5">
                                Enter your email address and a password reset link will be emailed to you.
                            </p>

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
                            <button type="submit"
                                    class="btn btn-twitter btn-block"
                            >
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
            </div>
        </div>
    </div>
@endsection
