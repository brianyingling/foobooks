<!doctype html>
<html>
<head>
    <title>@yield('title', 'Foobooks')</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" type='text/css'>
    <link href="/css/foobooks.css" type="text/css" rel="stylesheet">
    @stack('head')
</head>
<body>

    @if(session('alert'))
        <div class="alert">
            {{session('alert')}}
        </div>
    @endif

    <nav>
        <ul>
            @foreach(config('app.nav') as $link => $label)
                <li><a href='{{ $link }}' class='{{ Request::is(substr($link, 1)) ? 'active' : '' }}'>{{ $label }}</a>
            @endforeach
    
            <li>
                @if(Auth::check())
                <form method='POST' id='logout' action='/logout'>
                    {{ csrf_field() }}
                    <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                </form>
                @else
                    <a href='/login'>Login</a>
                @endif
            </li>
        </ul>
    </nav>
    
    <header>
        <a href="/">
            <img src="/images/foobooks-logo@2x.png" id="logo" alt="Foobooks logo">
        </a>
        {{--  @include('modules.nav')  --}}
    </header>
    <section>
        @yield('content')
    </section>

    <footer>
        &copy; {{date("Y")}}
    </footer>

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
</body>
</html>