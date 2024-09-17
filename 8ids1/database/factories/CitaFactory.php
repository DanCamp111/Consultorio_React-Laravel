<?php

namespace Database\Factories;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Especialidad;
use App\Models\Consultorio;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    protected $model = Cita::class;

    public function definition()
    {
        return [
            'id_paciente' => Paciente::factory(),
            'id_doctor' => Doctor::factory(),
            'id_especialidades' => Especialidad::factory(),
            'id_consultorio' => Consultorio::factory(),
            'fecha' => $this->faker->date,
            'observaciones' => $this->faker->paragraph,
            'estado' => 'pendiente',
        ];
    }
}
