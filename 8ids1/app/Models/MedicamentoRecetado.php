<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicamentoRecetado extends Model
{
    use HasFactory;
    protected $table = 'medicamento_recetado';

    protected $fillable = [
        'id_cita',
        'id_medicamento',
        'cantidad',
        'unidad',
        'cada_cuanto',
        'dias'
    ];
}
