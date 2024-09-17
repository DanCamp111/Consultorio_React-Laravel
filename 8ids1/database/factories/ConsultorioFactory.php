<?php

namespace Database\Factories;

use App\Models\Consultorio;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultorioFactory extends Factory
{
    protected $model = Consultorio::class;

    public function definition()
    {
        return [
            'numero' => $this->faker->randomNumber(),
        ];
    }
}

