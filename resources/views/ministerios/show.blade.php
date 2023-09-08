@extends('aplicacion')
@section('contenido')
<div class="columns">
    <div class="column is-one-quarter">
        <div class="box">
            <div class="title">{{ $ministerio->nombre }}</div>
            <div class="subtitle">{{ $ministerio->descripcion ?? 'Sin descripción' }}</div>  
            <br>
            <a href="{{ route('ministerios.edit', $ministerio) }}" class="button is-warning is-fullwidth">Editar</a>
        </div>
    </div>

    <div class="column">
        <x-card title="Miembros">
            <x-slot name="options">
                <x-modal-trigger modal-id="modalAgregarMiembroMinisterio" class="button is-link is-small">
                    <x-icons.plus />
                </x-modal-trigger>
            </x-slot>
        
            @if( $ministerio->tieneMiembros() )
            <x-table class="is-hoverable">
                <x-slot name="head">
                    <tr>
                        <th>Miembro</th>
                        <th>Funciones que desempeña</th>
                        <th></th>
                    </tr>
                </x-slot>
                @foreach($ministerio->miembros as $miembro)
                <tr>
                    <td>
                        <a href="{{ route('miembros.show', $miembro) }}">{{ $miembro->nombre_completo }}</a>
                        @includeWhen($miembro->esSuCumpleanios(), 'components.icons.cake')
                    </td>
                    <td>
                        <span>{{ $miembro->pivot->funciones }}</span>
                    </td>
                    <td class="has-text-right">
                        <x-modal-trigger modal-id="modalEditarMiembroMinisterio" class="button is-warning is-outlined is-small has-text-dark" data-miembro='{{ json_encode(["id" => $miembro->id, "nombres_apellidos" => $miembro->nombres_apellidos, "funciones" => $miembro->pivot->funciones]) }}'>
                            <span>Editar</span>
                        </x-modal-trigger>
        
                        <form action="{{ route('ministerios.miembro.destroy', $ministerio) }}" class="is-inline" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="miembro" value="{{ $miembro->id }}">
                            <button class="button is-danger is-outlined is-small" type="submit">Remover</button>
                        </form>
                    </td>
                </tr>    
                @endforeach
            </x-table>
        
            @else
            <p class="has-text-grey has-text-centered">Aún no tiene miembros...</p>
        
            @endif
        </x-card>
    </div>
</div>

@include('ministerios.show.modal-agregar-miembro-ministerio')
@include('ministerios.show.modal-editar-miembro-ministerio')
@endsection
