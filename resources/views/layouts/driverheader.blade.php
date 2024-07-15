<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>GoSchool - Dashboard</title>
</head>

<body>
    <header class="header">
        <!-- Dropdown menu bar -->
        <div class="dropdown">
            <button class="dropbtn" id="menuBtn">Menu</button>
            <div class="dropdown-content" id="menuContent">
                <a href="{{ route('driver') }}">Main Page</a>
                <a href="{{ route('completeTrips') }}">Check Profit</a>
                <a href="{{ route('logout') }}">LogOut</a>
            </div>
        </div>
        
        <!-- Brand logo -->
        <span class="go" style="color: #C4E4DC; margin-left: -5%; font-size: 36px;">Go</span><span class="school" style="color: #69C3B8; font-size: 36px;">School</span>
    </header>

    @yield('content')

    <script src="{{ asset('js/dropbox.js') }}"></script>
</body>
</html>
