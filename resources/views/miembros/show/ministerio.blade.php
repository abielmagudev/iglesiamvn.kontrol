<x-card title="Ministerios">
    @if( $miembro->perteneceAlgunMinisterio() )
    <x-table class="is-hoverable">
        <x-slot name="head">
            <tr>
                <th>Nombre</th>
                <th>Funciones que desempeña</th>
                <th></th>
            </tr>
        </x-slot>
        @foreach($miembro->ministerios as $ministerio)
        <tr>
            <td>{{ $ministerio->nombre }}</td>
            <td>{{ $ministerio->pivot->funciones }}</td>
            <td class="has-text-right">
                <a href="{{ route('ministerios.show', $ministerio) }}" class="button is-link is-outlined is-small">Mostrar</a>
            </td>
        </tr>
        @endforeach
    </x-table>
        
    @else
    <p class="has-text-centered">Aún no hay ministerios...</p>

    @endif
</x-card>
