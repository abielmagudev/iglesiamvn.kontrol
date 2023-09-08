<?php

namespace App\Models;

use App\Models\Kernel\HasExistentialTrait;
use App\Models\Kernel\HasFiltersTrait;
use App\Models\Kernel\HasReflectionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    use HasExistentialTrait;
    use HasFiltersTrait;
    use HasReflectionTrait;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha',
        'hora',
    ];

    protected $dates = [
        'fecha',
        'hora'
    ];

    public static $filters_request = [
        'descripcion_similar' => 'whereDescripcionSimilar',
        'descripcion' => 'whereTieneDescripcionToggle',
        'fecha_minima|fecha_maxima' => 'whereFechaMinimaMaximaToggle',
        'hora_minima|hora_maxima' => 'whereHoraMinimaMaximaToggle',
        'nombre_similar' => 'whereNombreSimilar',
    ];

    // Attributes

    public function getFechaRawAttribute()
    {
        return $this->isReal() ? $this->fecha->toDateString() : null;
    }
    
    public function getFechaHumanaAttribute()
    {
        return $this->isReal() ? $this->fecha->toFormattedDateString() : null;
    }

    public function getHoraRawAttribute()
    {
        return $this->isReal() ? $this->hora->toTimeString() : null;
    }

    public function getHoraHumanaAttribute()
    {
        return $this->isReal() ? $this->hora->format('g:i A') : null;
    }

    public function getHoraSinSegundosAttribute()
    {
        return $this->isReal() ? $this->hora->format('H:i') : null;
    }


    // Validations

    public function tieneDescripcion()
    {
        return isset($this->descripcion);
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



    public function scopeWhereHoraMinimaMaximaToggle($query, string $hora_minima = null, string $hora_maxima = null)
    {
        if( !strtotime($hora_minima) && !strtotime($hora_maxima) )
            return $query;

        if( strtotime($hora_minima) && !strtotime($hora_maxima) )
            return $query->whereFechaMinima($hora_minima);

        if( !strtotime($hora_minima) && strtotime($hora_maxima) )
            return $query->whereFechaMaxima($hora_maxima);

        return $query->whereBetweenHora($hora_minima, $hora_maxima);
    }

    public function scopeWhereBetweenHora($query, string $hora_minima, string $hora_maxima)
    {
        return $query->whereBetween('hora', [$hora_minima, $hora_maxima]);
    }

    public function scopeWhereHoraMaxima($query, string $hora_maxima)
    {
        return $query->where('fecha', '<=', $hora_maxima);
    }

    public function scopeWhereHoraMinima($query, string $hora_minima)
    {
        return $query->where('fecha', '>=', $hora_minima);
    }



    public function scopeWhereNombreSimilar($query, $nombre_similar)
    {
        if( empty($nombre_similar) ||! is_string($nombre_similar) )
            return $query;

        return $query->where('nombre', 'like', "%{$nombre_similar}%");
    }



    public function scopeWhereTieneDescripcionToggle($query, string $toggle = null)
    {
        if(! in_array($toggle, ['0','1']) )
            return $query;

        if( $toggle == '0' )
            return $query->whereNoTieneDescripcion();

        return $query->whereSiTieneDescripcion();
    }

    public function scopeWhereSiTieneDescripcion($query)
    {
        return $query->whereNotNull('descripcion');
    }

    public function scopeWhereNoTieneDescripcion($query)
    {
        return $query->whereNull('descripcion');
    }

    public function scopeWhereDescripcionSimilar($query, string $descripcion_similar = null)
    {
        if( empty($descripcion_similar) )
            return $query;

        return $query->where('descripcion', 'like', "%{$descripcion_similar}%");
    }
}
