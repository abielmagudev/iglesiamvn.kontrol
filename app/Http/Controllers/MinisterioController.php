<?php

namespace App\Http\Controllers;

use App\Http\Requests\MinisterioSaveRequest;
use App\Models\Ministerio;
use Illuminate\Http\Request;

class MinisterioController extends Controller
{
    public function index(Request $request)
    {
        $ministerios = Ministerio::withCount('miembros')
                                ->paginate(20)
                                ->appends($request->query());

        return view('ministerios.index', [
            'ministerios' => $ministerios,
            'request' => $request,
            'total' => $ministerios->total(),
        ]);
    }

    public function create()
    {
        return view('ministerios.create')->with('ministerio', new Ministerio);
    }

    public function store(MinisterioSaveRequest $request)
    {
        if(! $ministerio = Ministerio::create( $request->validated() ) )
            return back()->with('danger', 'Error al guardar ministerio, intentalo nuevamente...');

        return redirect()->route('ministerios.index')->with('success', "Ministerio <b>{$ministerio->nombre} ha sigo guardado</b>");
    }

    public function show(Ministerio $ministerio)
    {
        return view('ministerios.show')->with('ministerio', $ministerio);
    }

    public function edit(Ministerio $ministerio)
    {
        return view('ministerios.edit')->with('ministerio', $ministerio);
    }

    public function update(MinisterioSaveRequest $request, Ministerio $ministerio)
    {
        if(! $ministerio->fill( $request->validated() )->save() )
            return back()->with('danger', 'Error al actualizar ministerio, intentalo nuevamente...');

        return redirect()->route('ministerios.edit', $ministerio)->with('success', "Ministerio <b>{$ministerio->nombre}</b> ha sido actualizado");
    }

    public function destroy(Ministerio $ministerio)
    {
        if(! $ministerio->delete() )
            return back()->with('danger', 'Error al eliminar ministerio, intentalo nuevamente...');

        return redirect()->route('ministerios.index')->with('success', "Ministerio <b>{$ministerio->nombre}</b> ha sido eliminado");
    }
}
