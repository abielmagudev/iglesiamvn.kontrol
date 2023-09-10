<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiEventoRequest;
use App\Http\Resources\EventoCollectionResource;
use App\Models\Evento;
use Illuminate\Http\Request;

class ApiEventoController extends Controller
{
    public function index(ApiEventoRequest $request)
    {
        $eventos = Evento::whereYear('fecha', $request->anio)
                        ->whereMonth('fecha', $request->mes)
                        ->orderBy('fecha', 'asc')
                        ->get();

        return new EventoCollectionResource($eventos);
    }
}
