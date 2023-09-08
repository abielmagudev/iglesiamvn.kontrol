<?php

namespace App\Http\Controllers;

use App\Http\Requests\MiembroMinisterioSyncRequest;
use App\Models\Miembro;
use App\Models\Ministerio;
use Illuminate\Http\Request;

class MiembroMinisterioController extends Controller
{
    public function store(MiembroMinisterioSyncRequest $request, Ministerio $ministerio)
    {
        $ministerio->miembros()->attach($request->miembro, ['funciones' => $request->get('funciones')]);

        if(! $miembro = $ministerio->miembros->find($request->miembro) )
            return back()->with('danger', 'Error al guardar miembro al ministerio, inténtalo nuevamente...');
        
        return redirect()->route('ministerios.show', $ministerio)->with('success', "Miembro <b>{$miembro->nombre_completo}</b> ha sido guardado");
    }

    public function update(MiembroMinisterioSyncRequest $request, Ministerio $ministerio)
    {
        $ministerio->miembros()->updateExistingPivot($request->miembro, ['funciones' => $request->get('funciones')]);
        $miembro = $ministerio->miembros->find($request->miembro);

        if( $miembro->pivot->funciones <> $request->get('funciones') )
            return back()->with('danger', 'Error al actualizar miembro del ministerio, inténtalo nuevamente...');

        return redirect()->route('ministerios.show', $ministerio)->with('success', "Miembro <b>{$miembro->nombre_completo}</b> ha sido actualizado");
    }

    public function destroy(MiembroMinisterioSyncRequest $request, Ministerio $ministerio)
    {
        $ministerio->miembros()->detach($request->miembro);

        if( $ministerio->miembros->find($request->miembro) )
            return back()->with('danger', 'Error al remover miembro del ministerio, inténtalo nuevamente...');
            
        $miembro = Miembro::find($request->miembro);

        return redirect()->route('ministerios.show', $ministerio)->with('success', "Miembro <b>{$miembro->nombre_completo}</b> ha sido removido");
    }
}
