<x-modal id="modalAgregarFamilia">
    <div class="box">
        <p class="title">Familia de {{ $miembro->nombre_completo }}</p>
        <div class="field">
            <label for="inputSearchMiembro" class="label">Buscar miembro</label>
            
            {{-- Web component GetMiembroClicked --}}
            @include('web-components.GetMiembroClicked')

        </div>
        <form action="{{ route('miembros.familia.destroy', $miembro) }}" method="post" autocomplete="off" id="formAgregarFamilia">
            <div class="field">
                <label for="selectParentesco" class="label">Parentesco</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select id="selectParentesco" name="parentesco">
                            <option disabled selected label="Primero busca el miembro familiar..."></option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            @csrf
            <input type="hidden" name="familia" value="">
            <div class="buttons is-grouped is-right">
                <p class="control">
                  <button class="button is-success" type="submit">Agregar familia</button>
                </p>
                <p class="control">
                  <button class="button is-dark button-modal-close" type="button">Cancelar</button>
                </p>
            </div>            
        </form>
    </div>

    @foreach($familiaMiembro::getGenerosParentescos() as $genero => $parentescos)
    <template id="{{ $familiaMiembro::getTituloGenero($genero) }}ParentescosOptions">
        @foreach($parentescos as $parentesco)
        <option value="{{ $parentesco }}"><?= ucfirst($parentesco) ?></option>
        @endforeach
    </template>
    @endforeach

</x-modal>

@push('scripts')
<script>
const modalAgregarFamilia = {
    element: document.getElementById('modalAgregarFamilia'),
    form: function () {
        return this.element.querySelector('form#formAgregarFamilia')
    },
    inputControl: function () {
        return this.form().querySelector('input[name="familia"]')
    },
    selectControl: function () {
        return this.form().querySelector('select#selectParentesco')
    },
    cloneTemplateOptions: function (clave_genero) {
        let titulo_genero = clave_genero == 'f' ? 'femenino' : 'masculino';
        let template_id = 'template#' + titulo_genero + 'ParentescosOptions';
        let template = this.element.querySelector(template_id)
        return template.content.cloneNode(true)
    },
    load: function (miembro) {
        let template = this.cloneTemplateOptions( miembro.clave_genero_biologico )
        let options = [];

        for(let child of template.children)
        {
            let option = document.createElement('option')
            option.text = child.text
            option.value = child.value
            options.push(option)
        }  

        this.selectControl().innerHTML = ''
        this.selectControl().append(...options)
        this.inputControl().value = miembro.id
    },
    reset: function () {
        let option = document.createElement('option')
        option.label = 'Primero busca y selecciona el familiar...'
        option.disabled = true
        option.selected = true

        this.selectControl().innerHTML = ''
        this.selectControl().append(option)
        this.inputControl().value = ''
        // this.form().reset()
    },
    listen: function () {
        let self = this

        this.element.addEventListener('click', function (e) {
            ['modal-background', 'button-modal-close'].forEach(function (css_class) {
                if( e.target.classList.contains(css_class) )
                {
                    GetMiembroClicked.reboot()
                    self.reset()
                }
            })
        })
    }
}
modalAgregarFamilia.listen();

GetMiembroClicked.listen(miembro => modalAgregarFamilia.load(miembro))
</script>
@endpush
