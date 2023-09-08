@extends('aplicacion')
@section('contenido')
<x-card title="Editar visita">
    <form action="{{ route('visitas.update', $visita) }}" method="post" autocomplete="off">
        @include('visitas._form')
        @method('put')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-warning" type="submit">Actualizar visita</button>
            </div>
            <div class="control">
                <a href="{{ route('visitas.index') }}" class="button is-dark" target="_self">Regresar</a>
            </div>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirmar-eliminar :route="route('visitas.destroy', $visita)" text="Eliminar visita">
    <p>¿Deseas eliminar la visita <b>{{ $visita->nombre }}({{ $visita->fecha_humano }})</b>?</p>
</x-custom.modal-confirmar-eliminar>
@endsection
