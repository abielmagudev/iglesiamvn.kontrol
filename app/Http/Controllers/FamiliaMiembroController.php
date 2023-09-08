<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamiliaMiembroSyncRequest;
use App\Models\Miembro;
use App\Models\FamiliaMiembro;
use Illuminate\Http\Request;

class FamiliaMiembroController extends Controller
{
    public function store(FamiliaMiembroSyncRequest $request, Miembro $miembro)
    {
        $familia = Miembro::find( $request->familia );

        $miembro->suFamilia()->attach($familia->id, [
            'familia_parentesco' => $request->parentesco,
            'miembro_parentesco' => FamiliaMiembro::getParentescoRelacion($request->parentesco, $miembro->clave_genero_biologico),
        ]);

        return redirect()->route('miembros.show', $miembro)->with('success', "Familia <b>{$familia->nombre_completo}({$request->parentesco})</b> agregada");
    }

    public function destroy(FamiliaMiembroSyncRequest $request, Miembro $miembro)
    {
        $familia = $miembro->suFamilia->find($request->familia) ?? $miembro->esFamiliar->find($request->familia);
        
        $miembro->suFamilia()->detach($familia->id);
        $miembro->esFamiliar()->detach($familia->id);

        return redirect()->route('miembros.show', $miembro)->with('success', "Familia <b>{$familia->nombre_completo}</b> eliminado");
    }
}
