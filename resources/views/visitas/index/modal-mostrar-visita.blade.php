<x-modal id="modalMostrarVisita">
    <div class="box">
        <div></div>
        <br>
        <div class="has-text-right">
            <button class="button is-dark button-modal-close">Cerrar</button>
        </div>
    </div>
    <template>
        <p class="title"></p>
        <p class="subtitle"></p>
        <p class="m-0">
            <small>Explicación de su llegada</small>
        </p>
        <p>
            <em></em>
        </p>
        <br>
        <p class="m-0">
            <small>Respuestas al contactar</small>
        </p>
        <p>
            <em></em>
        </p>
    </template>
</x-modal>

@push('scripts')
<script>
const modalMostrarVisita = {
    element: document.getElementById('modalMostrarVisita'),
    triggers: document.querySelectorAll('button[data-visita]'),
    box: function () {
        return this.element.querySelector('.box > div:first-child')
    },
    template: function (visita) {
        let cloned = this.element.querySelector('template').content.cloneNode(true)
        let p = cloned.querySelectorAll('p > em')

        cloned.querySelector('.title').textContent = visita.nombre
        cloned.querySelector('.subtitle').textContent = visita.fecha
        p[0].textContent = visita.explicacion
        p[1].textContent = visita.respuestas

        return cloned
    },
    load: function (visita) {
        let cloned = this.template(visita)
        this.box().append(cloned)
    },
    clear: function () {
        this.box().innerHTML = ''
    },
    listen: function () {
        let self = this

        this.triggers.forEach(function (button) {
            button.addEventListener('click', (e) => {
                self.load( JSON.parse(button.dataset.visita) )
            })
        })

        this.element.addEventListener('click', (e) => {
            let classesClose = ['modal-background', 'button-modal-close']

            if( classesClose.some((classClose) => e.target.classList.contains(classClose)) ) {
                self.clear()
            }
        })
    }
}
modalMostrarVisita.listen()
</script>
@endpush
