@extends('aplicacion')
@section('contenido')
<div class="columns">
    <div class="column is-one-quarter">
        @include('miembros.show.perfil')
    </div>
    <div class="column">
        @includeWhen($miembro->esSuCumpleanios(), 'miembros.show.cumpleanios')

        @include('miembros.show.familia')
        <br>
        @include('miembros.show.ministerio')
    </div>
</div>

@include('miembros.show.modal-agregar-familia')
@endsection
