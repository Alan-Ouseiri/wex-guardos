<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'employee_number',
        'email',
    ];

    // Un docente puede tener muchas responsivas
    public function responsivas()
    {
        return $this->hasMany(Responsiva::class);
    }

    // Nombre completo (helper)
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }
}
