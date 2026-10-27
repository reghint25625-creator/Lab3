<?php

namespace App\Http\Requests;

use App\Enums\CarModel;
use App\Enums\ServiceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Carbon\Carbon;

class EntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_name'  => 'required|string|max:255',
            'car_model'    => ['required', new Enum(CarModel::class)],
            'service_type' => ['required', new Enum(ServiceType::class)],
            'booking_time' => [
                'required',
                'date',
                'unique:appointments,booking_time', // Защита от дублей в БД
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);

                    // Проверка на выходные (суббота = 6, воскресенье = 7)
                    if ($date->isWeekend()) {
                        $fail('Вихідні дні (субота та неділя) — закриті. Оберіть день з понеділка по п’ятницю.');
                    }

                    // Проверка рабочего времени (с 9:00 до 18:00)
                    $hour = $date->hour;
                    if ($hour < 9 || $hour >= 18) {
                        $fail('Автомайстерня працює з 9:00 до 18:00. Оберіть коректний час.');
                    }
                },
            ],
            'notes'        => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'client_name.required'  => 'Будь ласка, введіть ваше ім\'я.',
            'car_model.required'    => 'Будь ласка, оберіть марку авто.',
            'service_type.required' => 'Будь ласка, оберіть вид послуги.',
            'booking_time.required' => 'Будь ласка, оберіть бажаний час візиту.',
        ];
    }
}
