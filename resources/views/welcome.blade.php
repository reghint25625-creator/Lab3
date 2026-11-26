@extends('layouts.app')

@section('title', 'Головна - Автомайстерня СТО')

@section('content')
    <div style="background-color: white; width: 100%; max-width: 800px; padding: 35px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 5px solid #1f8135;">
        <h1 style="color: #0a3622; margin-top: 0; font-size: 26px;">
            Вітаємо на порталі сервісного центру СТО!
        </h1>

        <p style="color: #555; font-size: 15px; line-height: 1.6;">
            Веб-застосунок розроблено на основі фреймворку <strong>Laravel 12</strong> в рамках лабораторного практикуму.
            Предметна область: <em>Реляційна база даних автомайстерні (Облік клієнтів, автомобілів, майстрів та виконаних робіт)</em>.
        </p>

        <hr style="border: 0; border-top: 1px solid #e0e0e0; margin: 20px 0;">

        <p style="color: #222; font-size: 16px; margin: 0;">
            <strong>Виконав студент:</strong> Красюков Іван Андрійович, група РС-42.
        </p>
    </div>
@endsection
