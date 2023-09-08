@extends('aplicacion')
@section('contenido')
<x-card :title="sprintf('Visitas (%s)', $total)">
    <x-slot name="options">
        <x-modal-trigger modal-id="modalFiltrosVisitas" class="button is-link is-small mx-1">
            <x-icons.filter />
        </x-modal-trigger>

        <a href="{{ route('visitas.create') }}" class="button is-link is-small">
            @include('components.icons.plus')
        </a>
    </x-slot>

    @if( $visitas->count() )
    <x-table class="is-hoverable">
        <zx-slot name="head">
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Medios de contacto</th>
                <th></th>
            </tr>
        </zx-slot>
        @foreach($visitas as $visita)           
        <tr @class(['has-background-success-light' => $visita->tieneRespuestas()])>
            <td class="has-text-nowrap">{{ $visita->fecha_humano }}</td>
            <td class="has-text-nowrap">{{ $visita->nombre }}</td>
            <td>{{ $visita->medios_contacto }}</td>
            <td class="has-text-right">
                <x-modal-trigger modal-id="modalMostrarVisita" class="button is-link is-outlined is-small" :data-visita="$visita->dataModalMostrar()">
                    <span>Mostrar</span>
                </x-modal-trigger>
                <a href="{{ route('visitas.edit', $visita) }}" class="button is-warning is-outlined is-small has-text-dark" target="_self">Editar</a>
            </td>
        </tr>
        @endforeach
    </x-table>

    @else
    <p class="has-text-centered">No hay visitas...</p>

    @endif
</x-card>
<br>
<x-pagination :collection="$visitas" />

@include('visitas.index.modal-mostrar-visita')
@include('visitas.index.modal-filtros-visitas')
@endsection
