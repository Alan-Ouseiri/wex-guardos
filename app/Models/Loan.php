<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'teacher_id',
        'device_id',
        'location',
        'loan_date',
        'return_date',
        'status',
        'notes',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
