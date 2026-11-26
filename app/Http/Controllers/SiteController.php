<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Показ сторінки послуг з тижневим календарем
    public function repairForm(Request $request)
    {
        $weekOffset = (int) $request->get('week', 0);
        $selectedTime = $request->get('time');
        $appointmentId = $request->get('appointment'); // ID выбранной занятой записи

        $startDate = Carbon::now()->startOfWeek()->addWeeks($weekOffset);
        $endDate = (clone $startDate)->endOfWeek();

        $appointments = Appointment::whereBetween('booking_time', [$startDate, $endDate])->get();

        // Если запрошен просмотр деталей конкретной записи
        $selectedAppointment = null;
        if ($appointmentId) {
            $selectedAppointment = Appointment::find($appointmentId);
        }

        $weekDays = [];
        for ($i = 0; $i < 5; $i++) {
            $day = (clone $startDate)->addDays($i);
            $weekDays[] = [
                'date' => $day->format('Y-m-d'),
                'formatted' => $day->format('d.m.Y'),
                'name' => $day->translatedFormat('l'),
            ];
        }

        $workingHours = range(9, 17);

        return view('services', compact('weekDays', 'workingHours', 'appointments', 'weekOffset', 'selectedTime', 'selectedAppointment'));
    }

    // Збереження заявки в базу даних
    public function storeRepair(EntryRequest $request)
    {
        // Создаем запись в базе
        $appointment = Appointment::create($request->validated());

        // Передаем данные на страницу успеха
        return view('services-success', [
            'client_name' => $appointment->client_name,
            'car_model' => $appointment->car_model,
            'service_type' => $appointment->service_type,
            'booking_time' => $appointment->booking_time,
            'notes' => $appointment->notes,
        ]);
    }
}
