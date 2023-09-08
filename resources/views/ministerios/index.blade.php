@extends('aplicacion')
@section('contenido')
<x-card :title="sprintf('Ministerios (%s)', $total)">
    <x-slot name="options">
        <a href="{{ route('ministerios.create') }}" class="button is-link is-small">
            @include('components.icons.plus')
        </a>
    </x-slot>

    @if( $ministerios->count() )
    <div class="table-container">
        <table class="table is-hoverable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Miembros</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($ministerios as $ministerio)
                <tr>
                    <td>{{ $ministerio->nombre }}</td>
                    <td>{{ $ministerio->descripcion }}</td>
                    <td>{{ $ministerio->miembros_count }}</td>
                    <td class="has-text-right">
                        <a href="{{ route('ministerios.show', $ministerio) }}" class="button is-link is-outlined is-small">Mostrar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @else
    <p class="has-text-centered">No hay ministerios...</p>

    @endif
</x-card>
<br>
<x-pagination :collection="$ministerios" />
@endsection
