<x-modal id="modalFiltrosEventos">
    <div class="box">
        <p class="title">Filtrado de eventos</p>
        <form action="{{ route('eventos.index') }}" method="get" autocomplete="off">
            @include('eventos.index.modal-filtros-eventos.fechas')
            @include('eventos.index.modal-filtros-eventos.horas')
            @include('eventos.index.modal-filtros-eventos.nombre_similar')
            @include('eventos.index.modal-filtros-eventos.descripcion_similar')
            @include('eventos.index.modal-filtros-eventos.descripcion')
            <br>
            <div class="field is-grouped is-grouped-right">
                <div class="control">
                    <button class="button is-success" type="submit">Filtrar eventos</button>
                </div>
                <div class="control">
                    <button class="button is-dark button-modal-close" type="button">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</x-modal>
