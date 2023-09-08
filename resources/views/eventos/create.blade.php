@extends('aplicacion')
@section('contenido')
<x-card title="Nuevo evento">
    <form action="{{ route('eventos.store') }}" method="post" autocomplete="off">
        @include('eventos._form')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-success" type="submit">Guardar evento</button>
            </div>
            <div class="control">
                <a href="{{ route('eventos.index') }}" class="button is-dark" target="_self">Cancelar</a>
            </div>
        </div>
    </form>
</x-card>
@endsection
