@extends('layouts.app')

@section('title', 'Контакти — СТО')

@section('content')
    <div style="background-color: white; width: 100%; max-width: 800px; padding: 35px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 5px solid #1f8135;">
        <h1 style="color: #0a3622; margin-top: 0; font-size: 26px;">Контактна інформація</h1>
        <p style="color: #555; margin-bottom: 25px;">Інформація про розробника та відповідального майстра автосервісу:</p>

        <div style="display: flex; flex-direction: column; gap: 15px;">
            <div style="background: #f8f9fa; padding: 12px 18px; border-radius: 6px; border: 1px solid #e0e0e0;">
                <strong style="color: #0a3622;">ПІБ:</strong> Красюков Іван Андрійович
            </div>

            <div style="background: #f8f9fa; padding: 12px 18px; border-radius: 6px; border: 1px solid #e0e0e0;">
                <strong style="color: #0a3622;">Група:</strong> РС-42
            </div>

            <div style="background: #f8f9fa; padding: 12px 18px; border-radius: 6px; border: 1px solid #e0e0e0;">
                <strong style="color: #0a3622;">Навчальный заклад:</strong> КПІ ім. Ігоря Сікорського
            </div>

            <div style="background: #f8f9fa; padding: 12px 18px; border-radius: 6px; border: 1px solid #e0e0e0;">
                <strong style="color: #0a3622;">Email:</strong> reghint25625@gmail.com
            </div>

            <div style="background: #f8f9fa; padding: 12px 18px; border-radius: 6px; border: 1px solid #e0e0e0;">
                <strong style="color: #0a3622;">Телефон:</strong> +380 (50) 872-48-82
            </div>
        </div>
    </div>
@endsection
