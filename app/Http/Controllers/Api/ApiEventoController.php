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
        $query = Evento::whereYear('fecha', $request->anio);

        if(! is_null($request->mes) )
            $query->whereMonth('fecha', $request->mes);
        
        $eventos = $query->orderBy('fecha', 'asc')
                        ->orderBy('hora', 'asc')
                        ->get();

        return new EventoCollectionResource($eventos);
    }
}
