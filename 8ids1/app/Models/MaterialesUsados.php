<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialesUsados extends Model
{
    use HasFactory;
    protected $table = 'materiales_usados';

    protected $fillable = [
        'id_cita',
        'id_material',
        'cantidad',
        'unidad'
    ];
}
