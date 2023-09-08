<?php

namespace App\Models\Miembro;

use App\Models\FamiliaMiembro;
use App\Models\MiembroMinisterio;
use App\Models\Ministerio;

trait RelationshipsTrait
{
    public function conviveDomicilio()
    {
        return $this->belongsTo(self::class, 'domicilio_miembro_id');
    }

    public function convivenDomicilio()
    {
        return $this->hasMany(self::class, 'domicilio_miembro_id', 'id');
    }

    public function familia()
    {
        return $this->suFamilia->merge( $this->esFamiliar );
    }

    public function suFamilia()
    {
        // Columna relacional: miembro_id($this) & familia_id(foreing)
        return $this->belongsToMany(self::class, FamiliaMiembro::getTableName(), 'miembro_id', 'familia_id')
                ->withPivot(['familia_parentesco', 'miembro_parentesco'])
                ->using(FamiliaMiembro::class);
    }

    public function esFamiliar()
    {
        // Columna relacional: familia_id(foreign) & miembro_id($this)
        return $this->belongsToMany(self::class, FamiliaMiembro::getTableName(), 'familia_id', 'miembro_id')
                ->withPivot(['familia_parentesco', 'miembro_parentesco'])
                ->using(FamiliaMiembro::class);
    }

    public function ministerios()
    {
        return $this->belongsToMany(Ministerio::class)
                    ->using(MiembroMinisterio::class)
                    ->withPivot(['funciones']);
    }
}
