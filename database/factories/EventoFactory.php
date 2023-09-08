<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => sprintf('%s #%s', $this->faker->unique(true)->jobTitle(), mt_rand(1,999)),
            'descripcion' => $this->faker->optional()->sentence(),
            'fecha' => $this->faker->date(),
            'hora' => $this->faker->time(),
        ];
    }
}
