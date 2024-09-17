<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName,
            'ap_paterno' => $this->faker->lastName,
            'ap_materno' => $this->faker->lastName,
            'id_especialidades' => \App\Models\Especialidad::factory(),
            'cedula' => $this->faker->randomNumber(8),
            'telefono' => $this->faker->phoneNumber,
            'id_user' => \App\Models\User::factory(),
        ];
    }
}
