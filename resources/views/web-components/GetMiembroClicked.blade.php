<div id="componentGetMiembroClicked">
    {{-- Input search miembro --}}
    <div class="field is-fullwidth">
        <div class="control">
            <input type="search" id="inputSearchMiembro" class="input" name="input_search_miembro" value="{{ old('input_search_miembro') }}" placeholder="Escribe mínimo 3 letras del nombre del miembro...">
        </div>
    </div>

    {{-- Floating list miembros --}}
    <div id="wrapperFloatingListMiembros" class="is-relative" style="z-index:100; width:100%">
        <div id="floatingListMiembros" class="box is-hidden p-0" style="z-index:101; max-height:128px; width:100%; position:absolute; overflow:scroll">
            <ul id="listMiembros" class="m-0" style="z-index:102; list-style:none"></ul>
        </div>
    </div>

    {{-- Template list item miembro --}}
    <template id="templateListItemMiembro">
        <li class="has-background-light-hoverable is-clickable py-3 px-4">
            <div class="has-text-weight-bold"></div>
            <div></div>
            <div></div>
        </li>
    </template>
</div>

@once
@push('scripts')
<script>

// Component 
const GetMiembroClicked = {
    element: document.getElementById('componentGetMiembroClicked'),
    queryControl: function (value) {
        return this.element.querySelector(value);
    },
    display: function (boolean) {
        this.element.classList.toggle('is-hidden', !boolean)
    },
    inputFocus: function () {
        inputGetMiembroClicked.focus()
    },
    inputValue: function (value) {
        inputGetMiembroClicked.set(value);
    },
    request: async function (value) {
        let url = "<?= route('miembros.ajax.search') ?>" + '/' + value;
        let response = await fetch(url);
        let miembros = await response.json();
        return miembros;
    },
    reboot: function () {
        inputGetMiembroClicked.clear()
        listGetMiembroClicked.clear()
        listGetMiembroClicked.hide()
    },  
    listen: function (callable) {
        let self = this

        inputGetMiembroClicked.listen( async function (value) {
            if( value.length < 3 )
            {
                listGetMiembroClicked.hide()
                return;
            }

            let miembros = await self.request(value);

            listGetMiembroClicked.listen(miembros, callable)
        })

    }
}

// Input
const inputGetMiembroClicked = {
    element: GetMiembroClicked.queryControl('#inputSearchMiembro'),
    set: function (value) {
        this.element.value = value
    },
    focus: function () {
        this.element.focus()
    },
    clear: function () {
        this.element.value = ''
    },
    listen: function (whenWrite) {
        this.element.addEventListener('keyup', (e) => {
            whenWrite(e.target.value);
        }, false)
    }
}

// List
const listGetMiembroClicked = {
    element: GetMiembroClicked.queryControl('#listMiembros'),
    cache: [],
    find: function (miembro_id) {
        return this.cache.find(miembro => miembro.id == miembro_id);
    },
    messageIsEmpty: () => {
        let listItem = document.createElement('li')
        listItem.textContent = 'No se encontraron miembros...';
        listItem.classList.add('py-3', 'px-4')
        return listItem;
    },
    render: function (miembros) {
        this.clear()
        let children = [];

        if( miembros.length > 0 )
        {
            miembros.forEach((miembro) => {
                let child = templateGetMiembroClicked.create(miembro)
                children.push(child)
            })
        }
        else
        {
            children.push( this.messageIsEmpty() )
        }

        this.element.append(...children);
        this.show()
    },
    show: function () {
        this.element.parentNode.classList.remove('is-hidden');
    },
    hide: function () {
        this.element.parentNode.classList.add('is-hidden');
    },
    clear: function () {
        this.element.querySelectorAll('li').forEach((li) => li.remove())
    },
    listen: function (miembros, whenClick) {
        let self = this

        this.cache = miembros;
        this.render(this.cache)

        this.element.addEventListener('click', (e) => {
            e.stopPropagation()
            
            let clicked = e.target.tagName.toLowerCase() == 'li' ? e.target : e.target.closest('li');

            if( miembro = self.find( clicked.dataset.miembro ) )
            {
                GetMiembroClicked.inputValue(miembro.nombres_apellidos)
                whenClick(miembro)
                this.hide()
            }
        })
    }
}

// Template
const templateGetMiembroClicked = {
    element: GetMiembroClicked.queryControl('#templateListItemMiembro'),
    create: function (miembro) {
        let cloned = this.element.content.cloneNode(true);
        cloned.querySelector('li').setAttribute('data-miembro', miembro.id)

        let divs = cloned.querySelectorAll('div');
        divs[0].textContent = miembro.nombres_apellidos
        divs[1].textContent = miembro.direccion
        divs[2].textContent = miembro.localidad
        
        return cloned;
    }
}

</script> 
@endpush
@endonce
