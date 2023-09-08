<x-modal id="modalFiltrosVisitas">
    <div class="box">
        <p class="title">Filtrado de visitas</p>
        <form action="{{ route('visitas.index') }}" method="get" autocomplete="off">
            @include('visitas.index.modal-filtros-visitas.fechas')
            @include('visitas.index.modal-filtros-visitas.nombre_similar')
            @include('visitas.index.modal-filtros-visitas.respuestas')
            <br>
            <div class="field is-grouped is-grouped-right">
                <div class="control">
                    <button class="button is-success" type="submit">Filtrar visitas</button>
                </div>
                <div class="control">
                    <button class="button is-dark button-modal-close" type="button">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</x-modal>
