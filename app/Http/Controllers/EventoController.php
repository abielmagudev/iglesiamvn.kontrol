<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoSaveRequest;
use App\Models\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(Request $request)
    {
        $eventos = Evento::orderByDesc('fecha')
                        ->filtros($request)
                        ->paginate(20)
                        ->appends($request->query());

        return view('eventos.index', [
            'eventos' => $eventos,
            'request' => $request,
            'total' => $eventos->total(),
        ]);
    }

    public function create()
    {
        return view('eventos.create')->with('evento', new Evento);
    }

    public function store(EventoSaveRequest $request)
    {
        if(! $evento = Evento::create($request->validated()) )
            return back()->with('danger', 'Error al guardar evento, inténtalo nuevamente...');

        return redirect()->route('eventos.index')->with('success', "Evento <b>{$evento->nombre}</b> ha sido guardado");
    }

    public function show(Evento $evento)
    {
        return redirect()->route('eventos.index');
        // return view('eventos.show')->with('evento', $evento);
    }

    public function edit(Evento $evento)
    {
        return view('eventos.edit')->with('evento', $evento);
    }

    public function update(EventoSaveRequest $request, Evento $evento)
    {
        if( $evento->fill($request->validated())->save() == false )
            return back()->with('danger', 'Error al actualizar evento, inténtalo nuevamente...');

        return redirect()->route('eventos.edit', $evento)->with('success', "Evento <b>{$evento->nombre}</b> ha sido actualizado");
    }

    public function destroy(Evento $evento)
    {
        if(! $evento->delete() )
            return back()->with('danger', 'Error al eliminar el evento, inténtalo nuevamente...');

        return redirect()->route('eventos.index')->with('success', "Evento <b>{$evento->nombre}</b> ha sido eliminado");
    }
}
