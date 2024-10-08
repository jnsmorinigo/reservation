<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    /** @use HasFactory<\Database\Factories\WorkingHourFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'employee_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];


    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_working_hours');
    }
}
