<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Miembro;
use App\Models\Ministerio;
use App\Models\Visita;
use Illuminate\Http\Request;

class EscritorioController extends Controller
{
    public function index()
    {
        $miembros = Miembro::all();
        $ministerios = Ministerio::withCount('miembros')->orderByDesc('miembros_count')->get();
        $eventos = Evento::all();
        $visitas = Visita::all();

        $counters = (object) [
            'activos' => $miembros->where('activo', 1)->count(),
            'eventos' => $eventos->count(),
            'hombres' => $miembros->where('clave_genero_biologico', 'm')->count(),
            'inactivos' => $miembros->where('activo', 0)->count(),
            'ministerios' => $ministerios->count(),
            'mujeres' => $miembros->where('clave_genero_biologico', 'f')->count(),
            'miembros' => $miembros->count(),
            'visitas' => $visitas->count(),
            'visitas_si_atendidas' => $visitas->whereNotNull('respuestas')->count(),
            'visitas_no_atendidas' => $visitas->whereNull('respuestas')->count(),
        ];

        return view('escritorio.index', [
            'counters' => $counters,
            'eventos' => $eventos,
            'miembros' => $miembros,
            'ministerios' => $ministerios,
            'visitas' => $visitas,
        ]);
    }
}
