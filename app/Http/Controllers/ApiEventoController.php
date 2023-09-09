<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiEventoRequest;
use App\Http\Resources\EventoCollectionResource;
use App\Models\Evento;
use Illuminate\Http\Request;

class ApiEventoController extends Controller
{
    public function index(ApiEventoRequest $request, string $anio, string $mes)
    {
        $eventos = Evento::whereYear('fecha', $anio)
                        ->whereMonth('fecha', $mes)
                        ->orderBy('fecha', 'asc')
                        ->get();

        return new EventoCollectionResource($eventos);
    }
}
