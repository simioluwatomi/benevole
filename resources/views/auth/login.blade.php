@extends('layouts.auth')

@section('content')
    <div class="page">
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
                        <form class="card" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title text-center text-uppercase">Login to your account</div>
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ __('E-mail or Username') }}</label>
                                    <input
                                        name="email"
                                        id="email"
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter email address"
                                        autocomplete="email"
                                        autofocus
                                        required
                                        value="{{ old('email') }}"
                                        aria-describedby="emailHelp"
                                    >
                                    @error('email')
                                    @include('layouts.partials.invalid-feedback')
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        {{ __('Password') }}
                                        <a href="{{ route('password.request') }}"
                                           class="float-right">{{ __('Forgot Your Password?') }}</a>
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
                                <div class="form-group">
                                    <label class="custom-control custom-checkbox" for="remember">
                                        <input name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}
                                               class="custom-control-input"
                                               type="checkbox"
                                        >
                                        <span class="custom-control-label">
                                            {{ __('Remember Me') }}
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
                </div>
            </div>
        </div>
    </div>
@endsection
