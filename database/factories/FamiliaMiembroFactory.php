<?php

namespace Database\Factories;

use App\Models\FamiliaMiembro;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamiliaMiembroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $familia = $this->obtenerFamilia();
        $miembro = $this->obtenerMiembroDiferente($familia);

        return [
            'familia_id' => $familia->id,
            'miembro_id' => $miembro->id,
            'familia_parentesco' => $familia->parentesco,
            'miembro_parentesco' => $miembro->parentesco,
        ];
    }

    public function obtenerFamilia()
    {
        return (object) [
            'id' => mt_rand(1, 750),
            'parentesco' => $this->faker->randomElement( 
                FamiliaMiembro::getParentescos()
            ),
        ];
    }

    public function obtenerMiembroDiferente(object $familia)
    {
        return (object) [
            'id' => $this->faker->randomElement(
                array_filter(range(1, 750), function ($id) use ($familia) {
                    return $id <> $familia->id;
                })
            ),
            'parentesco' => FamiliaMiembro::getParentescoRelacion(
                $familia->parentesco, 
                (mt_rand(0, 1) ? 'f' : 'm')
            ),
        ];
    }
}
