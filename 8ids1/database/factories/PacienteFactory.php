<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    protected $model = Paciente::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->firstName,
            'ap_paterno' => $this->faker->lastName,
            'ap_materno' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
        ];
    }
}
