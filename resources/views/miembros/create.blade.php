@extends('aplicacion')
@section('contenido')
<x-card title='Nuevo miembro'>
    <form action="{{ route('miembros.store') }}" method="post" autocomplete="off">
        @include('miembros._form')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-success">Guardar miembro</button>
            </div>
            <div class="control">
                <a href="{{ route('miembros.index') }}" class="button is-dark">Cancelar</a>
            </div>
        </div>
    </form>
</x-card>
@endsection
