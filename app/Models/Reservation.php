<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;

    protected $fillable = [
        'appointment_date',
        'customer_id',
        'employee_id',
        'working_hour_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
