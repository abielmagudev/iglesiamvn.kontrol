<?php $setup = [
    'options' => App\Models\Miembro::getEstadosCiviles(),
] ?>

<div class="field">
    <label for="selectEstadoCivilFiltro" class="label">Estado civil</label>
    <x-form-control type="select" id="selectEstadoCivilFiltro" class="is-fullwidth" name="estado_civil">
        <option value="cualquiera" selected>Cualquiera</option>
        @foreach($setup['options'] as $value)
        <option value="{{ $value }}" {{ isSelected( $request->get('estado_civil') == $value ) }}>{{ ucfirst($value) }}(a)</option>
        @endforeach
    </x-form-control>
</div>
