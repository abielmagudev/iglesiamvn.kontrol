<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MinisterioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->jobTitle(),
            'descripcion' => $this->faker->optional()->sentence(),
        ];
    }
}
