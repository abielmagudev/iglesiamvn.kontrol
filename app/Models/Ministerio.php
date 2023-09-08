<?php

namespace App\Models;

use App\Models\Kernel\HasExistentialTrait;
use App\Models\Kernel\HasReflectionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministerio extends Model
{
    use HasFactory;
    use HasReflectionTrait;
    use HasExistentialTrait;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    
    // Validaciones

    public function tieneMiembros()
    {
        return (bool) ($this->miembros_count ?? $this->miembros->count());
    }


    // Relaciones

    public function miembros()
    {
        return $this->belongsToMany(Miembro::class)
                    ->using(MiembroMinisterio::class)
                    ->withPivot('funciones');
    }
}
