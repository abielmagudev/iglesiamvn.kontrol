<div class="mb-5">
    <form action="{{ route('miembros.index') }}" method="get" autocomplete="off">
        <div class="field">
            <div class="control">
                <input type="search" id="searchMiembros" name="buscar" value="{{ request('buscar', '') }}" class="input is-dark is-rounded is-borderless has-text-centered has-text-grey" style="background-color: rgba(0,0,0,0.06)" placeholder="Buscar miembro por nombre, apellido, móvil, teléfono, correo electrónico, ocupaciones..." required>
            </div>
        </div>
    </form>
</div>