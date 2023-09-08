<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Collection;
use App\Models\Kernel\HasExistentialTrait;
use App\Models\Kernel\HasFiltersTrait;
use App\Models\Kernel\HasReflectionTrait;
use App\Models\Miembro\RelationshipsTrait;
use App\Models\Miembro\ScopesTrait;
use App\Models\Miembro\ValidationsTrait;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Miembro extends Model
{
    use HasFactory;
    use HasExistentialTrait;
    use HasFiltersTrait;
    use HasReflectionTrait;

    use RelationshipsTrait;
    use ScopesTrait;
    use ValidationsTrait;

    public $table = 'miembros';

    protected $fillable = [
        // Personal
        'nombres',
        'apellidos',
        'nombres_apellidos',
        'clave_genero_biologico',
        'fecha_nacimiento',
        'lugar_nacimiento',
        'estado_civil',

        // Domicilio
        'domicilio_miembro_id',
        'direccion',
        'localidad',

        // Contacto
        'numero_movil',
        'numero_telefono',
        'correo_electronico',
        'web',

        // Adicional
        'emergencias',
        'ocupaciones',
        'notas',

        // Membresia
        'fecha_registro',
        'activo',
    ];

    protected $dates = [
        'fecha_nacimiento',
        'fecha_registro',
    ];

    public static $claves_titulos_generos_biologicos = [
        'f' => 'femenina',
        'm' => 'masculino',
    ];

    public static $estados_civiles = [
        'casado',
        'concubino',
        'divorciado',
        'separado',
        'soltero',
        'viudo',
    ];
    
    public static $localidades_predeterminadas = [
        'Nuevo Laredo, Tamaulipas, Mexico',
        'Laredo, Texas, EEUU',
    ];


    // Attributes setters

    public function setNombresAttribute($value)
    {
        $this->attributes['nombres'] = Str::title($value);
    }

    public function setApellidosAttribute($value)
    {
        $this->attributes['apellidos'] = Str::title($value);
    }



    // Attributes getters

    public function getNombreCompletoAttribute()
    {
        return $this->nombres_apellidos;
    }

    public function getGeneroBiologicoAttribute()
    {
        return self::getGenerosBiologicos()[ $this->clave_genero_biologico ];
    }
    
    public function getEstadoCivilRawAttribute()
    {
        return $this->attributes['estado_civil'] ?? null;
    }

    public function getEstadoCivilAttribute($value)
    {
        if( is_null($value) || $this->esGeneroMasculino() )
            return $value;

        return substr_replace($value, 'a', -1);
    }

    public function getFechaNacimientoRawAttribute()
    {
        return $this->fecha_nacimiento->toDateString();
    }

    public function getFechaNacimientoHumanoAttribute()
    {
        return $this->fecha_nacimiento->toFormattedDateString();
    }

    public function getEdadAttribute()
    {
        return Carbon::parse($this->fecha_nacimiento_raw)->age;
    }

    public function getEdadAniosAttribute()
    {
        if( $this->edad > 1 )
            return "{$this->edad} años";

        if( $this->edad == 1 )
            return "1 año";

        return "menos del año";
    }

    public function getFechaRegistroRawAttribute()
    {
        return $this->tieneFechaRegistro() ? $this->fecha_registro->toDateString() : null;
    }

    public function getFechaRegistroHumanoAttribute()
    {
        return $this->fecha_registro->toFormattedDateString();
    }

    public function getFechaRegistroDiferenciaAttribute()
    {
        return $this->fecha_registro->diffForHumans(now(), CarbonInterface::DIFF_ABSOLUTE);
    }

    public function getFamiliaCountAttribute()
    {
        return ($this->su_familia_count + $this->es_familiar_count) ?? null;
    }
    
    
    
    // Getters & Setters

    public static function getGenerosBiologicos()
    {
        return self::$claves_titulos_generos_biologicos;
    }

    public static function getClavesGenerosBiologicos()
    {
        return array_keys( self::getGenerosBiologicos() );
    }

    public static function getTitulosGenerosBiologicos()
    {
        return array_values( self::getGenerosBiologicos() );
    }

    public static function getEstadosCiviles()
    {
        return self::$estados_civiles;
    }

    public static function getLocalidadPredeterminada()
    {
        return self::$localidades_predeterminadas[0];
    }

    public static function getLocalidadesPredeterminadas()
    {
        return self::$localidades_predeterminadas;
    }
}
