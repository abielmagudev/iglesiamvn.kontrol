<x-modal id="modalFiltrosMiembros">
    <div class="box">
        <p class="title">Filtrado de miembros</p>
        <form action="{{ route('miembros.index') }}" method="get" autocomplete="off">
            {{-- Activo --}}
            @include('miembros.index.modal-filtros-miembros.membresia-estatus')

            {{-- Genero --}}
            @include('miembros.index.modal-filtros-miembros.generos')

            {{-- Edad --}}
            @include('miembros.index.modal-filtros-miembros.edades')

            {{-- Estados civiles --}}
            @include('miembros.index.modal-filtros-miembros.estados_civiles')

            {{-- Ocupaciones --}}
            @include('miembros.index.modal-filtros-miembros.ocupaciones_similar')

            <br>

            <div class="field is-grouped is-grouped-right">
                <div class="control">
                    <button class="button is-success" type="submit">Filtrar miembros</button>
                </div>
                <div class="control">
                    <button class="button is-dark button-modal-close" type="button">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</x-modal>
