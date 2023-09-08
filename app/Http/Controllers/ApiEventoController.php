<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventoCollectionResource;
use App\Models\Evento;
use Illuminate\Http\Request;

class ApiEventoController extends Controller
{
    public function index(string $numero_mes = null)
    {
        if( is_null($numero_mes) )
            $numero_mes = date('m');

        $eventos = Evento::whereYear('fecha', date('Y'))
                        ->whereMonth('fecha', $numero_mes)
                        ->orderBy('fecha', 'asc')
                        ->get();

        return new EventoCollectionResource($eventos);
    }
}
