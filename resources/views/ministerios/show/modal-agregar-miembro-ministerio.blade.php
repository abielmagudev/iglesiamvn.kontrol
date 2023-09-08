<x-modal id="modalAgregarMiembroMinisterio">
    <div class="box">
        <p class="title">Miembros de {{ $ministerio->nombre }}</p>
        <form action="{{ route('ministerios.miembro.store', $ministerio) }}" method="post" autocomplete="off" id="formAgregarMiembroMinisterio">
            @csrf
            <div class="field">
                <label for="inputSearchMiembro" class="label">Buscar miembro</label>
                
                {{-- Web component GetMiembroClicked --}}
                @include('web-components.GetMiembroClicked')

            </div>
            <div class="field">
                <label for="textareaFunciones" class="label">Funciones que desempeña</label>
                <div class="control">
                    <textarea id="textareaFunciones" class="textarea" name="funciones" rows="2" placeholder="(Opcional) Escribe las funciones del miembro que realiza en el ministerio..."></textarea>
                </div>
            </div>
            <br>
            <input type="hidden" name="miembro">
            <div class="buttons is-grouped is-right">
                <p class="control">
                  <button class="button is-success" type="submit">Agregar miembro</button>
                </p>
                <p class="control">
                  <button class="button is-dark button-modal-close" type="button">Cancelar</button>
                </p>
            </div>            
        </form>
    </div>
</x-modal>

@push('scripts')
<script>
const modalAgregarMiembroMinisterio = {
    element: document.getElementById('modalAgregarMiembroMinisterio'),
    form: function () {
        return this.element.querySelector('form#formAgregarMiembroMinisterio');
    },
    input: function () {
        return this.form().querySelector('input[name="miembro"]');
    },
    inputValue: function (miembro_id) {
        this.input().value = miembro_id
    },
    listen: function () {
        let self = this

        this.element.addEventListener('click', function (e) {
            ['modal-background', 'button-modal-close'].forEach(function (css_class) {
                if( e.target.classList.contains(css_class) )
                {
                    GetMiembroClicked.reboot()
                    self.form().reset()
                }
            })
        })
    }
}
modalAgregarMiembroMinisterio.listen()

GetMiembroClicked.listen(miembro => modalAgregarMiembroMinisterio.inputValue(miembro.id))
</script>
@endpush
