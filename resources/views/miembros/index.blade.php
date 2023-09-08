@extends('aplicacion')
@section('contenido')
<x-card :title="sprintf('Miembros (%s)', $total)">
    <x-slot name="options">
        <x-modal-trigger modal-id="modalFiltrosMiembros" class="button is-link is-small">
            <x-icons.filter />
        </x-modal-trigger>

        <x-modal-trigger modal-id="modalExportarMiembros" class="button is-link is-small mx-1">
            <x-icons.download />
        </x-modal-trigger>
        
        <a href="{{ route('miembros.create') }}" class="button is-link is-small">
            @include('components.icons.plus')
        </a>
    </x-slot>

    @if( $miembros->count() )
    <div class="table-container">
        <table class="table is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Móvil</th>
                    <th>Emergencias</th>
                    {{-- <th>Familia</th> --}}
                    {{-- <th>Ministerios</th> --}}
                    <th>Membresia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($miembros as $miembro)
                <tr>
                    <td class="has-text-nowrap">
                        <a href="{{ route('miembros.show', $miembro) }}">{{ $miembro->nombre_completo }}</a>
                        @includeWhen($miembro->esSuCumpleanios(), 'components.icons.cake')
                    </td>
                    <td>{{ $miembro->correo_electronico }}</td>
                    <td>{{ $miembro->numero_movil }}</td>
                    <td>{{ $miembro->emergencias }}</td>
                    {{-- <td>{{ $miembro->familia_count }}</td> --}}
                    {{-- <td>{{ $miembro->ministerios_count }}</td> --}}
                    <td>
                        <x-custom.tag-estatus-membresia :activo="$miembro->esActivo()" />    
                    </td>
                    <td class="has-text-right">
                        <a href="{{ route('miembros.edit', [$miembro, 'regresar' => url()->full()]) }}" class='button is-warning is-small is-outlined has-text-dark'>Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @else
    <p class="has-text-centered">No hay miembros...</p>
        
    @endif
</x-card>
<br>
<x-pagination :collection="$miembros" />

@include('miembros.index.modal-filtros-miembros')
@include('miembros.index.modal-exportar-miembros')
@endsection
