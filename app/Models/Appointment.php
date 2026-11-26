<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'client_name',
        'car_model',
        'service_type',
        'booking_time',
        'notes',
    ];

    protected $casts = [
        'booking_time' => 'datetime',
    ];
}
