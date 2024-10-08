<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTimeBlock extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeTimeBlockFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'employee_id',
        'work_date',
        'start_time',
        'end_time',
        'is_reserved',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
