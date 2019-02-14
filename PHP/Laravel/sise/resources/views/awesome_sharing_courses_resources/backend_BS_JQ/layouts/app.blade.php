<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            // 'signIn' => Auth::check()
            'signedIn' => Auth::check()
        ]) !!};
    </script>

    <style>
        body {
            padding-bottom: 100px;
        }
    
        .level {
            display: flex;
            align-items: center;
        }
    
        .flex {
            flex: 1
        }
    
        .mr-1 {
            margin-right: 1em;
        }
    
        [v-cloak] {
            display: none;
        }
    </style>

    @yield('header')

</head>

<body>
{{-- <a href="{{ route('register') }}">点此注册</a> --}}
    <div id="app">
    @include('awesome_sharing_courses_resources.backend_BS_JQ.layouts.navtop')
    @yield('content')

        <flash message="{{ session('flash') }}"></flash>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

</body>

</html>