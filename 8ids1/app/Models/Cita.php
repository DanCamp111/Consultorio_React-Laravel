<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'id_paciente',
        'fecha',
        'observaciones',
        'estado',
        'id_consultorio',
        'id_doctor',
        'id_especialidades'
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    // Relación con el modelo Especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'id_especialidades');
    }

    // Relación con el modelo Consultorio
    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class, 'id_consultorio');
    }

    // Relación con el modelo Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_doctor');
    }
    
    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'medicamento_recetado', 'id_cita', 'id_medicamento')
                    ->withPivot('cantidad', 'unidad', 'cada_cuanto', 'dias');
    }

    public function materiales()
    {
        return $this->belongsToMany(Material::class, 'materiales_usados', 'id_cita', 'id_material')
                    ->withPivot('cantidad', 'unidad');
    }

}
