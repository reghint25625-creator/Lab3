@extends('layouts.app')

@section('title', 'Заявку прийнято — СТО')

@section('content')
    <div style="background-color: white; width: 100%; max-width: 800px; padding: 35px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 5px solid #1f8135;">
        <h1 style="color: #0a3622; margin-top: 0; font-size: 26px;">✅ Заявку успішно прийнято!</h1>
        <ul style="line-height: 2; font-size: 16px; color: #333; margin-top: 20px;">
            <li><strong>Клієнт:</strong> {{ $client_name }}</li>
            <li><strong>Автомобіль:</strong> {{ $car_model }}</li>
            <li><strong>Послуга:</strong> {{ $service_type }}</li>
            <li><strong>Час візиту:</strong> {{ \Carbon\Carbon::parse($booking_time)->format('d.m.Y H:i') }}</li>
            @if(!empty($notes))
                <li><strong>Примітки:</strong> {{ $notes }}</li>
            @endif
        </ul>
        <div style="margin-top: 25px;">
            <a href="{{ route('home') }}" style="background-color: #0a3622; color: white; padding: 10px 18px; text-decoration: none; border-radius: 5px; font-weight: bold;">
                ← Повернутися назад
            </a>
        </div>
    </div>
@endsection
