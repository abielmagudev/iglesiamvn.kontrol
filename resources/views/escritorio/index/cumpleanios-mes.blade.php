<?php 
$cumpleanieros = $miembros->filter(function($miembro) { 
    return $miembro->esSuCumpleanios(); 
});

$index = 1;
?>

<div class="box">
    <div class="title">{{ now()->toFormattedDateString() }}</div>
    <div class="subtitle has-text-grey">
        <span>Cumpleañeros:</span>
        <b class="has-text-dark">{{ $cumpleanieros->count() }}</b>
    </div>
    
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
            <td>
                <a href="{{ route('miembros.show', $miembro) }}">{{ $miembro->nombre_completo }}</a>
                <x-icons.cake />
            </td>
            <td>{{ $miembro->edad_anios }}</td>
            <td>{{ $miembro->numero_movil }}</td>
            <td>{{ $miembro->numero_telefono }}</td>
            <td>{{ $miembro->correo_electronico }}</td>
            <td>
                <x-custom.tag-estatus-membresia :activo="$miembro->activo" />
            </td>
        </tr>
        @endforeach
    </x-table>
    @endif
</div>
