@extends('layouts.app')

@section('title', 'Послуги — Запис на ремонт')

@section('content')
    <div style="background-color: white; width: 100%; max-width: 900px; padding: 35px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-left: 5px solid #1f8135;">
        <h1 style="color: #0a3622; margin-top: 0; font-size: 26px;">Графік запису та починку</h1>
        <p style="color: #555; margin-bottom: 20px;">Оберіть вільний слот у таблиці нижче, щоб швидко записатися на ремонт, або натисніть на занятий, щоб переглянути деталі:</p>

        <!-- Навигация по неделям -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <a href="{{ route('services.form', ['week' => $weekOffset - 1]) }}" style="background: #0a3622; color: white; padding: 8px 14px; text-decoration: none; border-radius: 5px;">← Попередній тиждень</a>
            <span style="font-weight: bold; font-size: 16px; color: #333;">
                Тиждень: {{ $weekDays[0]['formatted'] }} — {{ $weekDays[4]['formatted'] }}
            </span>
            <a href="{{ route('services.form', ['week' => $weekOffset + 1]) }}" style="background: #0a3622; color: white; padding: 8px 14px; text-decoration: none; border-radius: 5px;">Наступний тиждень →</a>
        </div>

        <!-- Таблица-сетка -->
        <div style="overflow-x: auto; margin-bottom: 30px;">
            <table style="width: 100%; border-collapse: collapse; text-align: center; font-size: 14px;">
                <thead>
                <tr style="background-color: #f4f4f4;">
                    <th style="border: 1px solid #ccc; padding: 10px;">Час \ День</th>
                    @foreach($weekDays as $day)
                        <th style="border: 1px solid #ccc; padding: 10px;">
                            {{ ucfirst($day['name']) }}<br>
                            <span style="font-size: 12px; color: #666;">{{ $day['formatted'] }}</span>
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($workingHours as $hour)
                    <tr>
                        <td style="border: 1px solid #ccc; padding: 10px; font-weight: bold; background: #fafafa;">
                            {{ sprintf('%02d:00', $hour) }}
                        </td>
                        @foreach($weekDays as $day)
                            @php
                                $slotTime = $day['date'] . ' ' . sprintf('%02d:00:00', $hour);

                                $booked = $appointments->first(function($item) use ($slotTime) {
                                    return $item->booking_time->format('Y-m-d H:00') === \Carbon\Carbon::parse($slotTime)->format('Y-m-d H:00');
                                });
                            @endphp

                            <td style="border: 1px solid #ccc; padding: 10px;">
                                @if($booked)
                                    <!-- Кликабельная кнопка для просмотра деталей занятого слота -->
                                    <a href="{{ route('services.form', ['week' => $weekOffset, 'appointment' => $booked->id]) }}" style="display: inline-block; background: #ffebee; color: #c62828; padding: 6px 10px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 12px; border: 1px solid #ffcdd2;">
                                        🔴 Зайнято<br>({{ $booked->client_name }})
                                    </a>
                                @else
                                    <!-- Кликабельная ссылка для выбора свободного времени -->
                                    <a href="{{ route('services.form', ['week' => $weekOffset, 'time' => $slotTime]) }}" style="display: inline-block; background: #e8f5e9; color: #2e7d32; padding: 6px 10px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 12px; border: 1px solid #c8e6c9;">
                                        🟢 Записатись
                                    </a>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- БЛОК 1: Карточка деталей выбранной занятой записи -->
        @if(isset($selectedAppointment))
            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

            <div style="background: #fff3e0; padding: 20px; border-radius: 6px; border: 1px solid #ffe0b2;">
                <h2 style="color: #e65100; font-size: 20px; margin-top: 0; margin-bottom: 15px;">
                    📄 Деталі запису на {{ $selectedAppointment->booking_time->format('d.m.Y H:i') }}
                </h2>

                <ul style="line-height: 2; font-size: 15px; color: #333; margin: 0; padding-left: 20px;">
                    <li><strong>Клієнт:</strong> {{ $selectedAppointment->client_name }}</li>
                    <li><strong>Марка авто:</strong> {{ $selectedAppointment->car_model }}</li>
                    <li><strong>Вид послуги:</strong> {{ $selectedAppointment->service_type }}</li>
                    <li><strong>Час візиту:</strong> {{ $selectedAppointment->booking_time->format('d.m.Y H:i') }}</li>
                    @if(!empty($selectedAppointment->notes))
                        <li><strong>Примітки:</strong> {{ $selectedAppointment->notes }}</li>
                    @endif
                </ul>

                <div style="margin-top: 20px;">
                    <a href="{{ route('services.form', ['week' => $weekOffset]) }}" style="background: #e65100; color: white; padding: 8px 14px; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: bold;">
                        Закрити деталі
                    </a>
                </div>
            </div>
        @endif

        <!-- БЛОК 2: Форма для нового бронирования (появляется при клике на свободный слот) -->
        @if(isset($selectedTime))
            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

            <div style="background: #f9f9f9; padding: 20px; border-radius: 6px; border: 1px solid #e0e0e0;">
                <h2 style="color: #0a3622; font-size: 20px; margin-top: 0; margin-bottom: 15px;">
                    Оформлення заявки на: <span style="color: #1f8135;">{{ \Carbon\Carbon::parse($selectedTime)->format('d.m.Y H:i') }}</span>
                </h2>

                <form action="{{ route('services.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                    @csrf

                    <!-- Скрытое поле с автоматически переданным временем -->
                    <input type="hidden" name="booking_time" value="{{ $selectedTime }}">

                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Ваше ім'я:</label>
                        <input type="text" name="client_name" value="{{ old('client_name') }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                        @error('client_name') <span style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                    </div>

                    <div style="display: flex; gap: 15px;">
                        <div style="flex: 1;">
                            <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Марка авто:</label>
                            <select name="car_model" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                                <option value="">-- Оберіть марку --</option>
                                @foreach(App\Enums\CarModel::cases() as $car)
                                    <option value="{{ $car->value }}" {{ old('car_model') === $car->value ? 'selected' : '' }}>
                                        {{ $car->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('car_model') <span style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                        </div>

                        <div style="flex: 1;">
                            <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Вид послуги:</label>
                            <select name="service_type" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
                                <option value="">-- Оберіть послугу --</option>
                                @foreach(App\Enums\ServiceType::cases() as $service)
                                    <option value="{{ $service->value }}" {{ old('service_type') === $service->value ? 'selected' : '' }}>
                                        {{ $service->value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_type') <span style="color: red; font-size: 13px;">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label style="display: block; font-weight: bold; margin-bottom: 5px; color: #333;">Примітки:</label>
                        <textarea name="notes" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" style="background-color: #1f8135; color: white; padding: 12px 20px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 16px;">
                        Підтвердити запис
                    </button>
                </form>
            </div>
        @else
            @if(!isset($selectedAppointment))
                <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 6px; border: 1px dashed #ccc; color: #666; margin-top: 20px;">
                    Натисніть кнопку <strong>«Записатись»</strong> на вільному часі у таблиці вище для створення нової заявки або на <strong>«Зайнято»</strong> для перегляду деталей існуючої.
                </div>
            @endif
        @endif
    </div>
@endsection
