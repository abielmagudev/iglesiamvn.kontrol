<?php

namespace Database\Factories;

use App\Models\Miembro;
use Illuminate\Database\Eloquent\Factories\Factory;

class MiembroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $biological_genus_title = $this->faker->randomElement(['female','male']);
        $firstname = $this->faker->firstName($biological_genus_title);
        $lastname = $this->faker->lastName();
        
        return [
            // Personal
            'nombres' => $firstname,
            'apellidos' => $lastname,
            'nombres_apellidos' => "{$firstname} {$lastname}",
            'clave_genero_biologico' => substr($biological_genus_title, 0, 1),
            'fecha_nacimiento' => $this->faker->optional()->date(),
            'lugar_nacimiento' => $this->faker->boolean() ? sprintf('%s, %s', $this->faker->city(), $this->faker->country()) : null,
            'estado_civil' => $this->faker->optional()->randomElement(Miembro::getEstadosCiviles()),
            
            // Domicilio
            'domicilio_miembro_id' => $this->faker->optional()->numberBetween(1, 750),
            'direccion' => $this->faker->optional()->streetAddress(),
            'localidad' => $this->faker->boolean() ? $this->faker->country() : Miembro::getLocalidadPredeterminada(),
            
            // Contacto
            'numero_movil' => $this->faker->optional()->phoneNumber(),
            'numero_telefono' => $this->faker->optional()->phoneNumber(),
            'correo_electronico' => $this->faker->optional()->email,
            'web' => $this->faker->optional()->url,
            
            // Adicional
            'emergencias' => $this->faker->boolean() ? sprintf('%s: %s', $this->faker->name(), $this->faker->phoneNumber()) : null,
            'ocupaciones' => $this->faker->optional()->jobTitle(),
            'notas' => $this->faker->optional()->sentence(),
            
            // Membresia
            'fecha_registro' => $this->faker->date(),
            'activo' => (int) $this->faker->boolean(),
        ];
    }
}
