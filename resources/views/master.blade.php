<!doctype html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Language" content="en"/>
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#4188c9">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="{{ mix('css/index.css') }}" rel="stylesheet">

        @stack('styles')

        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    </head>

    <body class="antialiased">

        <div class="page" id="app">

            <div class="content">

                @include('partials.header')

                <div class="content-page">

                    <main class="container my-4 flex-fill">

                        @if (session('message'))
                            <notification-component
                                type="{{ session('message.type') }}"
                                body="{{ session('message.body') }}"
                            >
                            </notification-component>
                        @endif

                        @yield('content')

                    </main>

                </div>

            </div>

            @include('partials.footer')

            @stack('modal')

        </div>

        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>

        @stack('scripts')

    </body>

</html>
