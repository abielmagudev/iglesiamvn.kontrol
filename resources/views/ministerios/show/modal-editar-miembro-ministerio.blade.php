<x-modal id="modalEditarMiembroMinisterio">
    <div class="box">
        <p class="title">Miembros de {{ $ministerio->nombre }}</p>
        <div class="field">
            <label for="nombreMiembroMinisterio" class="label">Nombre del miembro</label>
            <div class="control">
                <div class="input" id="nombreMiembroMinisterio"></div>
            </div>
        </div>
        <form action="{{ route('ministerios.miembro.update', $ministerio) }}" method="post" autocomplete="off" id="formEditarMiembroMinisterio">
            @csrf
            @method('put')
            <input type="hidden" name="miembro">
            <div class="field">
                <label for="textareaFunciones" class="label">Funciones que desempeña</label>
                <div class="control">
                    <textarea id="textareaFunciones" class="textarea" name="funciones" rows="2" placeholder="(Opcional) Escribe las actividades del miembro dentro del ministerio..."></textarea>
                </div>
            </div>
            <br>
            <div class="buttons is-grouped is-right">
                <p class="control">
                  <button class="button is-warning" type="submit">Actualizar miembro</button>
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
const modalEditarMiembroMinisterio = {
    element: document.getElementById('modalEditarMiembroMinisterio'),
    form: function () {
        return this.element.querySelector('form#formEditarMiembroMinisterio');
    },
    nombre: function () {
        return this.element.querySelector('#nombreMiembroMinisterio');
    },
    input: function () {
        return this.form().querySelector('input[name="miembro"]');
    },
    textarea: function () {
        return this.form().querySelector('textarea[name="funciones"]');
    },
    load: function (miembro) {
        this.nombre().textContent = miembro.nombres_apellidos
        this.input().value = miembro.id
        this.textarea().value = miembro.funciones
    },
    listen: function () {
        let self = this

        document.querySelectorAll('button[data-target="modalEditarMiembroMinisterio"]').forEach(function (button) {
            button.addEventListener('click', function (e) {
                let button = e.target.tagName.toLowerCase() == 'button' ? e.target : e.target.closest('button') ;
                self.load( JSON.parse(button.dataset.miembro) )
            })
        })

        this.element.addEventListener('click', function (e) {            
            ['modal-background', 'button-modal-close'].forEach(function (css_class) {
                if( e.target.classList.contains(css_class) )
                {
                    self.nombre().textContent = ''
                    self.input().value = ''
                    self.form().reset()
                }
            })
        })
    }
}
modalEditarMiembroMinisterio.listen()
</script>
@endpush
