@extends('aplicacion')
@section('contenido')
<x-card title="Nuevo usuario">
    <form action="{{ route('usuarios.store') }}" method="post" autocomplete="off">
        @include('usuarios._form')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-success">Guardar usuario</button>
            </div>
            <div class="control">
                <a href="{{ route('usuarios.index') }}" class="button is-dark">Cancelar</a>
            </div>
        </div>
    </form>
</x-card>
@include('usuarios._script-rellenar-usuario')
@endsection
