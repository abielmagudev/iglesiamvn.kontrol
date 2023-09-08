@extends('aplicacion')
@section('contenido')
<x-card title="Nuevo ministerio">
    <form action="{{ route('ministerios.store') }}" method="post">
        @include('ministerios._form')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-success">Guardar ministerio</button>
            </div>
            <div class="control">
                <a href="{{ route('ministerios.index') }}" class="button is-dark">Cancelar</a>
            </div>
        </div>
    </form>
</x-card>
@endsection
