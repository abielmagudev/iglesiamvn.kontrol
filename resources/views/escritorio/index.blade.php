@extends('aplicacion')
@section('contenido')
@include('escritorio.index.counter-total-miembros')

@include('escritorio.index.cumpleanios-mes')

<div class="columns">
    <div class="column">
        @include('escritorio.index.counter-total-ministerios')
    </div>
    <div class="column">
        @include('escritorio.index.counter-total-eventos')
    </div>
    <div class="column">
        @include('escritorio.index.counter-total-visitas')
    </div>
</div>
@endsection
