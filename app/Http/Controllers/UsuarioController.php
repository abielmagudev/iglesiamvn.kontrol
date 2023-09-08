<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioSaveRequest;
use App\Models\User;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('usuarios.index', [
            'usuarios' => User::whereNotAutenticado(auth()->user()->id)->orderByDesc('id')->get(),
        ]);
    }

    public function create()
    {
        return view('usuarios.create', [
            'usuario' => new User,
        ]);
    }

    public function store(UsuarioSaveRequest $request)
    {
        if(! $usuario = User::create( $request->validated() ) )
            return back()->with('danger', 'Error al guardar usuario, inténtalo nuevamente...');

        return redirect()->route('usuarios.index')->with('success', "Usuario <b>{$usuario->name}({$usuario->email})</b> se ha guardado");
    }

    public function show(User $usuario)
    {
        return redirect()->route('usuarios.index');
    }

    public function edit(User $usuario)
    {
        return view('usuarios.edit', [
            'usuario' => $usuario,
        ]);
    }

    public function update(UsuarioSaveRequest $request, User $usuario)
    {
        if(! $usuario->fill( $request->validated() )->save() )
            return back()->with('danger', 'Error al actualizar usuario, inténtalo nuevamente...');

        return redirect()->route('usuarios.edit', $usuario)->with('success', "Usuario <b>{$usuario->name}({$usuario->email})</b> ha sido actualizado");
    }

    public function destroy(User $usuario)
    {
        if(! $usuario->delete() )
            return back()->with('danger', 'Error al eliminar usuario, inténtalo nuevamente...');
        
        return redirect()->route('usuarios.index')->with('success', "Usuario <b>{$usuario->name}({$usuario->email})</b> ha sido eliminado");
    }
}
