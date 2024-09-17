<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;
    protected $table = 'medicamentos';
    protected $fillable = ['codigo', 'descripcion', 'precio', 'fecha_caducidad', 'existencias'];

    public function citas()
    {
        return $this->belongsToMany(Cita::class, 'medicamento_recetado', 'id_medicamento', 'id_cita')
                    ->withPivot('cantidad', 'unidad', 'cada_cuanto', 'dias');
    }
}

