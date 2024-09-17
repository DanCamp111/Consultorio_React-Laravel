<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'materiales';
    protected $fillable = ['codigo', 'descripcion', 'precio', 'fecha_caducidad', 'existencia'];

    public function citas()
    {
        return $this->belongsToMany(Cita::class, 'materiales_usados', 'id_material', 'id_cita')
                    ->withPivot('cantidad', 'unidad');
    }
}
