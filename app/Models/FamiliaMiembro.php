<?php

namespace App\Models;

use App\Models\Kernel\HasReflectionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FamiliaMiembro extends Pivot
{
    use HasFactory;
    use HasReflectionTrait;

    protected $table = 'familia_miembro';

    public $timestamps = false;

    public static $generos_parentescos_relaciones = [

        // Femenina
        'f' => [
            'esposa' => [
                'm' => 'esposo',
            ],
            'hermana' => [
                'f' => 'hermana',
                'm' => 'hermano',
            ],
            'hermanastra' => [
                'f' => 'hermanastra',
                'm' => 'hermanastro',
            ],
            'hija' => [
                'f' => 'madre',
                'm' => 'padre',
            ],
            'hijastra' => [
                'f' => 'madrastra',
                'm' => 'padrastro',
            ],
            'madrastra' => [
                'f' => 'hijastra',
                'm' => 'hijastro',
            ],
            'madre' => [
                'f' => 'hija',
                'm' => 'hijo'
            ],
        ],

        // Masculino
        'm' => [
            'esposo' => [
                'f' => 'esposa',
            ],
            'hermano' => [
                'f' => 'hermana',
                'm' => 'hermano',
            ],
            'hermanastro' => [
                'f' => 'hermanastra',
                'm' => 'hermanastro',
            ],
            'hijo' => [
                'f' => 'madre',
                'm' => 'padre',
            ],
            'hijastro' => [
                'f' => 'madrastra',
                'm' => 'padrastro',
            ],
            'padrastro' => [
                'f' => 'hijastra',
                'm' => 'hijastro',
            ],
            'padre' => [
                'f' => 'hija',
                'm' => 'hijo',
            ],
        ],
    ];

    public static $idiomas_generos_titulos = [
        'esp' => [
            'f' => 'femenino',
            'm' => 'masculino',
        ],
        'eng' => [
            'f' => 'female',
            'm' => 'male',
        ],
    ];

    public static function getGenerosParentescosRelaciones()
    {
        return self::$generos_parentescos_relaciones;
    }

    public static function getGenerosParentescos()
    {
        foreach(self::getGenerosParentescosRelaciones() as $genero => $parentescos)
            $array[$genero] = array_keys($parentescos);

        return $array;
    }

    public static function getGeneroParentesco(string $clave_genero)
    {
        if(! isset( self::getGenerosParentescosRelaciones()[$clave_genero] ) )
            return array();

        return self::getGenerosParentescosRelaciones()[$clave_genero];
    }

    public static function getParentescosRelaciones()
    {
        return array_merge(
            self::getGeneroParentesco('f'),
            self::getGeneroParentesco('m')
        );
    }

    public static function getParentescos()
    {
        return array_keys( self::getParentescosRelaciones() );
    }

    public static function getParentescoRelacion(string $parentesco, string $clave_genero)
    {
        $parentescos_relaciones = self::getParentescosRelaciones();

        if(! array_key_exists($parentesco, $parentescos_relaciones) )
            return 'desconocido';

        $relaciones = $parentescos_relaciones[$parentesco];

        if(! array_key_exists($clave_genero, $relaciones) )
            return array_shift($relaciones);

        return $relaciones[ $clave_genero ];       
    }

    public static function getGenerosTitulos()
    {
        return self::$idiomas_generos_titulos['esp'];
    }

    public static function getGendersTitles()
    {
        return self::$idiomas_generos_titulos['eng'];
    }

    public static function getTituloGenero(string $clave_genero)
    {
        return self::getGenerosTitulos()[$clave_genero];
    }

    public static function getGenderTitle(string $gender_key)
    {
        return self::getGendersTitles()[$gender_key];
    }
}
