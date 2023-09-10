<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventoCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($evento) {
            return [
                'id' => $evento->id,
                'nombre' => $evento->nombre,
                'descripcion' => $evento->descripcion,
                'fecha' => $evento->fecha_raw,
                'fecha_humana' => $evento->fecha_humana,
                'hora' => $evento->hora_humana,
                'dia' => $evento->fecha->day,
                'mes_nombre' => nombreMesNumero($evento->fecha->month),
                'mes' => $evento->fecha->month,
                'anio' => $evento->fecha->year,
            ];
        });
    }

    public function with($request)
    {
        return [
            'status' => 200
        ];
    }
}
