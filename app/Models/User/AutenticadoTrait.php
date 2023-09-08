<?php

namespace App\Models\User;

trait AutenticadoTrait
{
    public function scopeWhereAutenticado($query, $autenticado_id)
    {
        return $query->where('id', $autenticado_id);
    }

    public function scopeWhereNotAutenticado($query, $autenticado_id)
    {
        return $query->where('id', '<>', $autenticado_id);
    }
}
