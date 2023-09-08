<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VisitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->date(),
            'nombre' => $this->faker->name(),
            'medios_contacto' => $this->faker->optional()->phoneNumber(),
            'explicacion' => $this->faker->optional()->sentence(),
            'respuestas' => $this->faker->optional()->sentence(),
        ];
    }
}
