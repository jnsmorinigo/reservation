<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'specialty',
        'timezone',
        'country',
        'lunch_break_start',
        'lunch_break_end',
        'block_duration',
    ];

    public function getAvailableBlocks($startTime, $endTime)
    {
        return $this->employeeTimeBlocks()
            ->whereBetween('work_date', [$startTime->toDateString(), $endTime->toDateString()])
            ->whereTime('start_time', '>=', $startTime->toTimeString())
            ->whereTime('end_time', '<=', $endTime->toTimeString())
            ->where('is_reserved', false)
            ->get();
    }

    public function getReservedBlocks($startTime, $endTime)
    {
        return $this->employeeTimeBlocks()
            ->whereBetween('work_date', [$startTime->toDateString(), $endTime->toDateString()])
            ->whereTime('start_time', '>=', $startTime->toTimeString())
            ->whereTime('end_time', '<=', $endTime->toTimeString())
            ->where('is_reserved', true)
            ->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employeeTimeBlocks()
    {
        return $this->hasMany(EmployeeTimeBlock::class);
    }
    public function workingHours()
    {
        return $this->belongsToMany(WorkingHour::class, 'employee_working_hours');
    }

}
