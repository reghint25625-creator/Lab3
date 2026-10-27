<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Довідник країн')</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .error { color: red; font-size: 0.9em; }
        nav a { margin-right: 15px; }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('country.index') }}">Країни</a>
</nav>
<hr>
@yield('content')
</body>
</html>
