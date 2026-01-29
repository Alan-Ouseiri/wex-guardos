<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsiva extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'responsiva_number',
        'teacher_id',
        'device_id',
        'assigned_date',
        'returned_date',
        'status',
        'condition',
        'location',
        'verification_code',
        'delivered_by',
    ];

    protected $dates = [
        'assigned_date',
        'returned_date',
        'deleted_at'
    ];

    // Pertenece a un docente
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // Pertenece a un dispositivo
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    // Usuario que creó la responsiva
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Historial de cambios
    public function histories()
    {
        return $this->hasMany(ResponsivaHistory::class);
    }
}
