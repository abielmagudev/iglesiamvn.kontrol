@extends('aplicacion')
@section('contenido')
<x-card :title="sprintf('Eventos (%s)', $total)">
    <x-slot name="options">
        <x-modal-trigger modal-id="modalFiltrosEventos" class="button is-link is-small mx-1">
            <x-icons.filter />
        </x-modal-trigger>

        <a href="{{ route('eventos.create') }}" class="button is-link is-small">
            @include('components.icons.plus')
        </a>
    </x-slot>

    @if( $eventos->count() )
    <x-table class="is-hoverable">
        <zx-slot name="head">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Día</th>
                <th>Hora</th>
                <th></th>
            </tr>
        </zx-slot>
        @foreach($eventos as $evento)           
        <tr>
            <td>{{ $evento->nombre }}</td>
            <td>{!! $evento->tieneDescripcion() ? convertirLinks($evento->descripcion) : '' !!}</td>
            <td class="has-text-nowrap">{{ $evento->fecha_humana }}</td>
            <td class="has-text-nowrap">{{ ucfirst($evento->nombre_dia_semana) }}</td>
            <td class="has-text-nowrap">{{ $evento->hora_humana }}</td>
            <td class="has-text-right">
                <a href="{{ route('eventos.edit', $evento) }}" class="button is-warning is-outlined is-small has-text-dark" target="_self">Editar</a>
            </td>
        </tr>
        @endforeach
    </x-table>

    @else
    <p class="has-text-centered">No hay eventos...</p>  

    @endif
</x-card>
<br>
<x-pagination :collection="$eventos" />
@include('eventos.index.modal-filtros-eventos')
@endsection
