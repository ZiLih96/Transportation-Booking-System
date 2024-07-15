<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: url('../images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #080808; /* Adjust text color based on background */
        }

        .header {
            background: rgba(23, 111, 88, 0.8); /* Background color with transparency */
            padding: 10px; /* Add padding */
            font-weight: bold;
            font-size: 30px;
            text-align: center;
        }

        .navbar-brand {
            position: absolute;
            width: 100%;
            text-align: center;
            left: 0;
            right: 0;
            color: #fff; /* Set text color */
        }

        .navbar-brand .go {
            color: #C4E4DC;
        }

        .navbar-brand .school {
            color: #69C3B8;
        }

        .navbar-nav {
            display: none; /* Hide the navigation links */
        }
    </style>
</head>
<body>
    <div id="app">
    <header class="header">
        <span class="go" style="color: #C4E4DC;">Go</span><span class="school" style="color: #69C3B8;">School</span>
    </header>

        <main class="py-4">
            <br>
            @yield('content')
        </main>
    </div>
</body>
</html>
