<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'brand',
        'model',
        'serial_number',
        'status',
    ];

    // Un dispositivo puede aparecer en muchas responsivas
    public function responsivas()
    {
        return $this->hasMany(Responsiva::class);
    }

    // Descripción del dispositivo
    public function getDescriptionAttribute()
    {
        return "{$this->brand} {$this->type} {$this->model} - Serie: {$this->serial_number}";
    }
}
