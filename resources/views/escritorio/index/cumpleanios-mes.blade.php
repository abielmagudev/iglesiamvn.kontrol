<?php 
$cumpleanieros = $miembros->filter(function($miembro) { 
    return $miembro->esSuCumpleanios(); 
});

$index = 1;
?>

<div class="box">
    <div class="title">{{ $cumpleanieros->count() }} cumpleañero(s)</div>
    <div class="subtitle">Hoy {{ now()->toFormattedDateString() }}</div>
    
    @if( $cumpleanieros->count() )
    <x-table class='is-fullwidth is-hoverable'>
        <x-slot name="head">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Móvil</th>
                <th>Teléfono</th>
                <th>Correo electrónico</th>
                <th>Estatus</th>
            </tr>
        </x-slot>
        @foreach($cumpleanieros as $miembro)           
        <tr>
            <td style="width:1%">{{ $index++ }}</td>
            <td class="has-text-nowrap">
                <div>
                    <a href="{{ route('miembros.show', $miembro) }}">{{ $miembro->nombre_completo }}</a>
                    <x-icons.cake />
                </div>
            </td>
            <td class="has-text-nowrap">{{ $miembro->edad_anios }}</td>
            <td class="has-text-nowrap">{{ $miembro->numero_movil }}</td>
            <td class="has-text-nowrap">{{ $miembro->numero_telefono }}</td>
            <td>{{ $miembro->correo_electronico }}</td>
            <td>
                <x-custom.tag-estatus-membresia :activo="$miembro->activo" />
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</div>
