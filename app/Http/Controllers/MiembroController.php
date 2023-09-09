<?php

namespace App\Http\Controllers;

use App\Http\Requests\MiembroSaveRequest;
use App\Models\FamiliaMiembro;
use App\Models\Miembro;
use Illuminate\Http\Request;

class MiembroController extends Controller
{
    public function index(Request $request)
    {
        $miembros = Miembro::withCount(['esFamiliar','suFamilia','ministerios'])
                            ->orderByDesc('id')
                            ->filtros($request)
                            ->paginate(20)
                            ->appends($request->query());

        return view('miembros.index', [
            'miembros' => $miembros,
            'request' => $request,
            'total' => $miembros->total(),
        ]);
    }

    public function create()
    {
        return view('miembros.create', [
            'miembro' => new Miembro,
            'predeterminados' => (object) [
                'estados_civiles' => Miembro::getEstadosCiviles(),
                'localidad' => Miembro::getLocalidadPredeterminada(),
                'localidades' => Miembro::getLocalidadesPredeterminadas(),
            ],
        ]);
    }

    public function store(MiembroSaveRequest $request)
    {
        if(! $miembro = Miembro::create($request->validated()) )
            return back()->with('danger', 'Error al guardar nuevo miembro, inténtalo nuevamente...');

        return redirect()->route('miembros.index')->with('success', "Miembro <b>{$miembro->nombre_completo}</b> ha sido guardado");
    }

    public function show(Miembro $miembro)
    {
        return view('miembros.show', [
            'miembro' => $miembro,
            'familiaMiembro' => FamiliaMiembro::class
        ]);
    }

    public function edit(Miembro $miembro)
    {
        return view('miembros.edit', [
            'miembro' => $miembro,
            'predeterminados' => (object) [
                'estados_civiles' => Miembro::getEstadosCiviles(),
                'localidad' => Miembro::getLocalidadPredeterminada(),
                'localidades' => Miembro::getLocalidadesPredeterminadas(),
            ],
            'regresar' => request('regresar', route('miembros.show', $miembro))
        ]);
    }

    public function update(MiembroSaveRequest $request, Miembro $miembro)
    {
        if(! $miembro->fill($request->validated())->update() )
            return back()->with('danger', 'Error al actualizar miembro, inténtalo nuevamente...');

        $message = "Miembro <b>{$miembro->nombre_completo}</b> ha sido actualizado";
        
        $convivientes = Miembro::whereConviveDomicilio($miembro->id)->get();
        
        if( $convivientes->count() )
        {
            Miembro::whereIn('id', $convivientes->pluck('id'))->update(
                $request->only(['direccion', 'localidad'])
            );

            $message .= ", asi como el domicilio de los miembros que conviven";
        }

        $regresar = $request->get('regresar', route('miembros.show', $miembro));
        
        return redirect()->route('miembros.edit', [$miembro, 'regresar' => $regresar])->with('success', $message);
    }

    public function destroy(Miembro $miembro)
    {
        if(! $miembro->delete() )
            return back()->with('danger', 'Error al eliminar miembro, inténtalo nuevamente...');
    
        Miembro::whereConviveDomicilio($miembro->id)->update([
            'domicilio_miembro_id' => null
        ]);

        return redirect()->route('miembros.index')->with('success', "Miembro <b>{$miembro->nombre_completo}</b> ha sido eliminado");
    }
}
