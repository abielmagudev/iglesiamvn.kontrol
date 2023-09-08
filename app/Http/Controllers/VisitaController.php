<?php

namespace App\Http\Controllers;

use App\Http\Requests\VisitaSaveRequest;
use App\Models\Visita;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    public function index(Request $request)
    {
        $visitas = Visita::filtros($request)
                        ->orderByDesc('fecha')
                        ->paginate(20)
                        ->appends($request->query());

        return view('visitas.index', [
            'visitas' => $visitas,
            'request' => $request,
            'total' => $visitas->total(),
        ]);
    }

    public function create()
    {
        return view('visitas.create')->with('visita', new Visita);
    }

    public function store(VisitaSaveRequest $request)
    {
        if(! $visita = Visita::create( $request->validated() ) )
            return back()->with('danger', 'Error al guardar visita, inténtalo nuevamente...');
        
        return redirect()->route('visitas.index')->with('success', "Visita <b>{$visita->nombre}({$visita->fecha_humano})</b> ha sido guardada");
    }

    public function show(Visita $visita)
    {
        return redirect()->route('visitas.index');
    }

    public function edit(Visita $visita)
    {
        return view('visitas.edit')->with('visita', $visita);
    }

    public function update(VisitaSaveRequest $request, Visita $visita)
    {
        if( $visita->fill($request->validated())->save() === false )
            return back()->with('danger', 'Error al actualizar visita, inténtalo nuevamente...');
       
        return redirect()->route('visitas.edit', $visita)->with('success', "Visita <b>{$visita->nombre}({$visita->fecha_humano})</b> ha sido actualizada");
    }

    public function destroy(Visita $visita)
    {
        if(! $visita->delete() )
            return back()->with('danger', 'Error al eliminar visita, inténtalo nuevamente...');

        return redirect()->route('visitas.index')->with('success', "Visita <b>{$visita->nombre}({$visita->fecha_humano})</b> ha sido eliminada");
    }
}
