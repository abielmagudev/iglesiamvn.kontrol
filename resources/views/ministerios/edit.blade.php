@extends('aplicacion')
@section('contenido')
<x-card title="Editar ministerio">
    <form action="{{ route('ministerios.update', $ministerio) }}" method="post">
        @method('put')
        @include('ministerios._form')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-warning">Actualizar ministerio</button>
            </div>
            <div class="control">
                <a href="{{ route('ministerios.show', $ministerio) }}" class="button is-dark">Regresar</a>
            </div>
        </div>
    </form>
</x-card>
<br>
<x-custom.modal-confirmar-eliminar :route="route('ministerios.destroy', $ministerio)" text="Eliminar ministerio">
    <p>¿Deseas eliminar ministerio <b>{{ $ministerio->nombre }}</b>?</p>
</x-custom.modal-confirmar-eliminar>
@endsection
