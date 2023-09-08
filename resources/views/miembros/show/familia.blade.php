<x-card title="Familia">
    <x-slot name="options">
        <x-modal-trigger modal-id="modalAgregarFamilia" class="button is-link is-small">
            <x-icons.plus />
        </x-modal-trigger>
    </x-slot>

    @if( $miembro->familia()->count() )
    <x-table class="is-hoverable">
        <x-slot name="head">
            <tr>
                <th>Nombre</th>
                <th>Parentesco</th>
                <th>Edad</th>
                <th>Membresia</th>
                <th></th>
            </tr>
        </x-slot>

        @foreach($miembro->familia() as $familia)
                <tr>
                    <td>
                        <a href="{{ route('miembros.show', $familia) }}">{{ $familia->nombre_completo }}</a>
                        @includeWhen($familia->esSuCumpleanios(), 'components.icons.cake')
                    </td>
                    <td class="is-capitalized">
                        {{ $miembro->id == $familia->pivot->miembro_id ? $familia->pivot->familia_parentesco : $familia->pivot->miembro_parentesco }}
                    </td>
                    <td>
                        <span>{{ $familia->tieneFechaNacimiento() ? ucfirst($familia->edad_anios) : '' }}</span>
                    </td>
                    <td>
                        <x-custom.tag-estatus-membresia :activo="$familia->esActivo()" />
                    </td>
                    <td>
                        <form action="{{ route('miembros.familia.destroy', $miembro) }}" method="post" class="has-text-right">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="familia" value="{{ $familia->id }}">
                            <button class="button is-small is-danger is-outlined" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </x-table>

    @else
    <p class="has-text-centered">Aún no hay familia...</p>

    @endif
</x-card>
