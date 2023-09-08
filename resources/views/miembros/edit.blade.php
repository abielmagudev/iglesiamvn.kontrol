@extends('aplicacion')
@section('contenido')
<x-card title='Editar miembro'>
    <form action="{{ route('miembros.update', $miembro) }}" method="post" autocomplete="off">
        @include('miembros._form')
        @method('put')
        <input type="hidden" name="regresar" value="{{ $regresar }}">
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-warning">Actualizar miembro</button>
            </div>
            <div class="control">
                <a href="{{ $regresar }}" class="button is-dark">Regresar</a>
            </div>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirmar-eliminar :route="route('miembros.destroy', $miembro)" text="Eliminar miembro">
    <p>¿Deseas eliminar miembro <b>{{ $miembro->nombre_completo }}</b>?</p>
</x-custom.modal-confirmar-eliminar>
@endsection
