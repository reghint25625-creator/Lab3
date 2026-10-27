<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Лабораторний практикум — СТО')</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; display: flex; flex-direction: column; min-height: 100vh;">

<!-- Навигация -->
<nav style="background-color: #0a3622; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center;">
    <div style="color: white; font-size: 18px; font-weight: bold;">
        🚗 <span>Автомайстерня «AutoService»</span>
    </div>
    <div>
        <a href="{{ route('home') }}" style="color: white; margin-right: 15px; text-decoration: none; font-weight: bold;">Головна</a>
        <a href="{{ route('services.form') }}" style="color: white; margin-right: 15px; text-decoration: none;">Послуги</a>
        <a href="{{ route('about') }}" style="color: white; margin-right: 15px; text-decoration: none;">Про застосунок</a>
        <a href="{{ route('contact') }}" style="color: white; text-decoration: none;">Контакти</a>
    </div>
</nav>

<!-- Основной контент -->
<main style="flex: 1; padding: 40px 20px; display: flex; justify-content: center; align-items: flex-start;">
    @yield('content')
</main>

<!-- Подвал -->
<footer style="background-color: #1f8135; border-top: 2px solid #19e753; padding: 15px; text-align: center; color: white;">
    <div style="font-weight: bold; margin-bottom: 5px;">Автомайстерня / Сервісний центр СТО</div>
    &copy; {{ date('Y') }} КПІ ім. Ігоря Сікорського | Розробив: Красюков Іван Андрійович (Група РС-42)
</footer>

</body>
</html>
