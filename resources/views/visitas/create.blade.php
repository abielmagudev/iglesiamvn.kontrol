@extends('aplicacion')
@section('contenido')
<x-card title="Nueva visita">
    <form action="{{ route('visitas.store') }}" method="post" autocomplete="off">
        @include('visitas._form')
        <br>
        <div class="field is-grouped is-grouped-right">
            <div class="control">
                <button class="button is-success" type="submit">Guardar visita</button>
            </div>
            <div class="control">
                <a href="{{ route('visitas.index') }}" class="button is-dark" target="_self">Cancelar</a>
            </div>
        </div>
    </form>
</x-card>
@endsection
