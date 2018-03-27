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