@extends('aplicacion')
@section('contenido')
<x-card title="Editar usuario">
    <form action="{{ route('usuarios.update', $usuario) }}" method="post" autocomplete="off">
        @include('usuarios._form')
        @method('put')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-warning">Actualizar usuario</button>
            </div>
            <div class="control">
                <a href="{{ route('usuarios.index') }}" class="button is-dark">Regresar</a>
            </div>
        </div>
    </form>
</x-card>
<br>
@include('usuarios._script-rellenar-usuario')
<x-custom.modal-confirmar-eliminar :route="route('usuarios.destroy', $usuario)" text="Eliminar usuario">
    <p>¿Deseas eliminar usuario <b>{{ $usuario->name }}({{ $usuario->email }})</b>?</p>
</x-custom.modal-confirmar-eliminar>
@endsection
