<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutenticadoSaveRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AutenticadoController extends Controller
{
    public function edit()
    {
        return view('autenticado.edit')->with('usuario', auth()->user());
    }

    public function update(AutenticadoSaveRequest $request)
    {
        $validated = $request->validated();

        if( isset($validated['password']) )
            $validated['password'] = Hash::make($validated['password']);

        if(! User::whereAutenticado( auth()->user()->id )->update( $validated ) )
            return back()->with('danger', 'Error al actualizar tu cuenta, inténtalo nuevamente...');

        return redirect()->route('autenticado.edit')->with('success', 'Tu cuenta ha sido actualizada');
    }
}
