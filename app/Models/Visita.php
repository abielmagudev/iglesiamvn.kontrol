<?php

namespace App\Models;

use App\Models\Kernel\HasExistentialTrait;
use App\Models\Kernel\HasFiltersTrait;
use App\Models\Kernel\HasReflectionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Visita extends Model
{
    use HasFactory;
    use HasExistentialTrait;
    use HasFiltersTrait;
    use HasReflectionTrait;

    protected $fillable = [
        'fecha',
        'nombre',
        'medios_contacto',
        'explicacion',
        'respuestas',
    ];

    protected $dates = [
        'fecha',
    ];

    public static $filters_request = [
        'fecha_minima|fecha_maxima' => 'whereFechaMinimaMaximaToggle',
        'nombre_similar' => 'whereNombreSimilar',
        'respuestas' => 'whereTieneRespuestasToggle',
    ];


    // Attributes

    public function getFechaRawAttribute()
    {
        return $this->isReal() ? $this->attributes['fecha'] : null;
    }

    public function getFechaHumanoAttribute()
    {
        return $this->isReal() ? $this->fecha->toFormattedDateString() : null;
    }

    public function dataModalMostrar()
    {
        return json_encode([
            'fecha' => $this->fecha_humano,
            'nombre' => $this->nombre,
            'medios_contacto' => $this->medios_contacto,
            'explicacion' => $this->explicacion,
            'respuestas' => $this->respuestas,
        ]);
    }
    
    // Validations

    public function tieneRespuestas()
    {
        return isset($this->respuestas);
    }


    // Scopes

    public function scopeWhereFechaMinimaMaximaToggle($query, string $fecha_minima = null, string $fecha_maxima = null)
    {
        if( !strtotime($fecha_minima) && !strtotime($fecha_maxima) )
            return $query;

        if( strtotime($fecha_minima) && !strtotime($fecha_maxima) )
            return $query->whereFechaMinima($fecha_minima);

        if( !strtotime($fecha_minima) && strtotime($fecha_maxima) )
            return $query->whereFechaMaxima($fecha_maxima);

        return $query->whereBetweenFecha($fecha_minima, $fecha_maxima);
    }

    public function scopeWhereBetweenFecha($query, string $fecha_minima, string $fecha_maxima)
    {
        return $query->whereBetween('fecha', [$fecha_minima, $fecha_maxima]);
    }

    public function scopeWhereFechaMaxima($query, string $fecha_maxima)
    {
        return $query->where('fecha', '<=', $fecha_maxima);
    }

    public function scopeWhereFechaMinima($query, string $fecha_minima)
    {
        return $query->where('fecha', '>=', $fecha_minima);
    }



    public function scopeWhereNombreSimilar($query, $nombre_similar)
    {
        return $query->where('nombre', 'like', "%{$nombre_similar}%");
    }



    public function scopeWhereTieneRespuestasToggle($query, $toggle)
    {
        if(! in_array($toggle, ['0','1']) )
            return $query;

        if( $toggle == '0' )
            return $query->whereNoTieneRespuestas();

        return $query->whereSiTieneRespuestas();
    }

    public function scopeWhereSiTieneRespuestas($query)
    {
        return $query->whereNotNull('respuestas');
    }

    public function scopeWhereNoTieneRespuestas($query)
    {
        return $query->whereNull('respuestas');
    }
}
