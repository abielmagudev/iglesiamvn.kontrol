<?php

namespace App\Models\Miembro;

use Illuminate\Support\Str;

trait ScopesTrait
{
    public static $filters_request = [
        'buscar' => 'buscar',
        'membresia' => 'whereActivo',
        'edad_minima|edad_maxima' => 'whereEdadMinimaMaximaToggle',
        'estado_civil' => 'whereEstadoCivil',
        'genero' => 'whereGenero',
        'ocupaciones_similar' => 'whereOcupacionesSimilar',
    ];

    public function scopeBuscar($query, string $value = null)
    {
        if( is_null($value) || empty($value))
            return $query;

        return $query->whereNombresApellidos($value)
                    ->orWhere('numero_movil', 'like', "%{$value}%")
                    ->orWhere('numero_telefono', 'like', "%{$value}%")
                    ->orWhere('correo_electronico', 'like', "%{$value}%")
                    ->orWhere('ocupaciones', 'like', "%{$value}%");
    }

    public function scopeWhereNombresApellidos($query, string $value)
    {
        return $query->where('nombres_apellidos', 'like', "%{$value}%")
                    ->orWhere('nombres_apellidos', 'like', sprintf('%%%s%%', Str::title($value)));
    }

    public function scopeWhereConviveDomicilio($query, $id)
    {
        return $query->where('domicilio_miembro_id', $id);
    }

    public function scopeWhereActivo($query, $status)
    {
        if(! in_array($status, ['0','1']) )
            return $query;

        return $query->where('activo', $status);
    }

    public function scopeWhereEdadMinimaMaximaToggle($query, $edad_minima = null, $edad_maxima = null)
    {
        // Edad_maxima ni edad_minima son valores enteros
        if( !ctype_digit($edad_minima) && !ctype_digit($edad_maxima) )
            return $query;
        
        // Solo edad_minima es valor entero
        if( ctype_digit($edad_minima) && !ctype_digit($edad_maxima) )
            return $query->whereEdadMinima($edad_minima);

        // Solo edad_maxima es valor entero
        if( !ctype_digit($edad_minima) && ctype_digit($edad_maxima) )
            return $query->whereEdadMaxima($edad_maxima);
        
        return $query->whereBetweenEdad($edad_minima, $edad_maxima);
    }

    public function scopeWhereBetweenEdad($query, $edad_minima, $edad_maxima)
    {
        $fecha_nacimiento_minima = now()->subYears($edad_minima)->toDateString(); 
        $fecha_nacimiento_maxima = now()->subYears($edad_maxima)->toDateString();
        
        return $query->whereNotNull('fecha_nacimiento')->whereBetween('fecha_nacimiento', [$fecha_nacimiento_maxima, $fecha_nacimiento_minima]); 
    }

    public function scopeWhereEdadMinima($query, $edad_minima)
    {
        $fecha_nacimiento_minima = now()->subYears($edad_minima)->toDateString(); 

        return $query->whereNotNull('fecha_nacimiento')->whereDate('fecha_nacimiento', '<=', $fecha_nacimiento_minima);
    }

    public function scopeWhereEdadMaxima($query, $edad_maxima)
    {
        $fecha_nacimiento_maxima = now()->subYears($edad_maxima)->toDateString(); 

        return $query->whereNotNull('fecha_nacimiento')->whereDate('fecha_nacimiento', '>=', $fecha_nacimiento_maxima);
    }



    public function scopeWhereEstadoCivil($query, $estado_civil)
    {
        if(! in_array($estado_civil, self::getEstadosCiviles()) )
            return $query;

        return $query->where('estado_civil', $estado_civil);
    }

    public function scopeWhereGenero($query, string $clave_genero_biologico)
    {
        if(! in_array($clave_genero_biologico, ['f', 'm']) )
            return $query;

        return $query->where('clave_genero_biologico', $clave_genero_biologico);
    }
    
    public function scopeWhereOcupacionesSimilar($query, string $ocupaciones_similar = null)
    {
        if( empty($ocupaciones_similar) )
            return $query;

        return $query->where('ocupaciones', 'like', "%{$ocupaciones_similar}%");
    } 
}
