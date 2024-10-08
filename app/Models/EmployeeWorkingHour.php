<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWorkingHour extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeWorkingHourFactory> */
    use HasFactory;


    protected $table = 'employee_working_hours';

    protected $fillable = [
        'employee_id',
        'working_hour_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function workingHour()
    {
        return $this->belongsTo(WorkingHour::class);
    }
}
