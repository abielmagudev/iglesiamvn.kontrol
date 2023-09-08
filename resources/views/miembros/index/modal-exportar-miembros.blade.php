<x-modal id="modalExportarMiembros">
    <div class="box">
        <div class="has-text-centered">
            <div class="title">Lista actual de miembros</div>
            <div class="subtitle">Haz clic en el formato de archivo a descargar</div>
        </div>
        <br>
        <div class="columns is-centered">
            <div class="column">
                <a href="{{ route('miembros.export.excel', array_merge($request->query(), ['format' => 'xlsx']) ) }}" class="button is-success is-large has-text-weight-bold is-size-5 is-width-100" style="min-width:224px" download>EXCEL</a>
            </div>
            <div class="column">
                <a href="{{ route('miembros.export.pdf', array_merge($request->query(), ['format' => 'pdf']) ) }}" class="button is-success is-large has-text-weight-bold is-size-5 is-width-100" style="min-width:224px" download>PDF</a>
            </div>
        </div>
        <br>
        <div class="has-text-right">
            <button class="button is-dark button-modal-close" type="button">Cerrar</button>
        </div>
    </div>
</x-modal>

@push('scripts')
<script>
const modalExportarMiembros = {
    element: document.getElementById('modalExportarMiembros'),
    listen: function () {
        let self = this

        this.element.addEventListener('click', (e) => {
            let clicked = e.target

            if( clicked.tagName == 'A' && clicked.classList.contains('button') )
            {
                clicked.classList.add('is-loading')

                window.addEventListener('blur', () => {
                    clicked.classList.remove('is-loading')
                })
            }
        })
    }
}
modalExportarMiembros.listen()
</script>
@endpush
