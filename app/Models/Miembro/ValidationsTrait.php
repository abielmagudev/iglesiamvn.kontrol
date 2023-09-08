<?php

namespace App\Models\Miembro;

use Illuminate\Support\Carbon;

trait ValidationsTrait
{
    public function esActivo()
    {
        return (bool) $this->activo;
    }

    public function esInactivo()
    {
        return ! $this->esActivo();
    }

    public function esGeneroFemenino()
    {
        return $this->clave_genero_biologico == 'f';
    }

    public function esGeneroMasculino()
    {
        return $this->clave_genero_biologico == 'm';
    }

    public function tieneFechaNacimiento()
    {
        return isset($this->fecha_nacimiento);
    }

    public function esSuCumpleanios()
    {
        return $this->tieneFechaNacimiento() && Carbon::parse($this->fecha_nacimiento_raw)->isBirthday();
    }

    public function estaConviviendoDomicilio()
    {
        return is_int($this->domicilio_miembro_id) && is_a($this->conviveDomicilio, self::class);
    }

    public function perteneceAlgunMinisterio()
    {
        return (bool) ($this->ministerios_count || $this->ministerios->count());
    }

    public function tieneFechaRegistro()
    {
        return isset($this->fecha_registro);
    }

    public function tieneWeb()
    {
        return isset($this->web);
    }
}
