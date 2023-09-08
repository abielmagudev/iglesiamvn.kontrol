@extends('aplicacion')
@section('contenido')
<x-card title="Editar evento">
    <form action="{{ route('eventos.update', $evento) }}" method="post" autocomplete="off">
        @include('eventos._form')
        @method('put')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-warning" type="submit">Actualizar evento</button>
            </div>
            <div class="control">
                <a href="{{ route('eventos.index') }}" class="button is-dark" target="_self">Regresar</a>
            </div>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirmar-eliminar :route="route('eventos.destroy', $evento)" text="Eliminar evento">
    <p>¿Deseas eliminar el evento <b>{{ $evento->nombre }}</b>?</p>
</x-custom.modal-confirmar-eliminar>
@endsection
