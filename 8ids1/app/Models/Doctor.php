<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctores';

    protected $fillable = [
        'nombre',
        'ap_paterno',
        'ap_materno',
        'id_especialidades',
        'cedula',
        'telefono',
        'id_user'
    ];

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidades');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

