<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsivaHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'responsiva_id',
        'action',
        'description',
        'action_date',
    ];

    // Pertenece a una responsiva
    public function responsiva()
    {
        return $this->belongsTo(Responsiva::class);
    }

    // Usuario que hizo el cambio
    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
