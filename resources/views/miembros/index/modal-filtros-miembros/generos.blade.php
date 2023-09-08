<?php $setup = [
    'Cualquiera' => [
        'value' => 'cualquiera',
        'selected' => ! in_array($request->genero, ['f','m']),
    ],
    'Femenino' => [
        'value' => 'f',
        'selected' => $request->genero == 'f',      
    ],
    'Masculino' => [
        'value' => 'm',
        'selected' => $request->genero == 'm',      
    ],
] ?>

<div class="field">
    <label for="selectGeneroFiltro" class="label">Género</label>
    <x-form-control type="select" id="selectGeneroFiltro" class="is-fullwidth" name="genero">
        @foreach($setup as $text => $props)
        <option value="{{ $props['value'] }}" {{ isSelected($props['selected']) }}>{{ $text }}</option>
        @endforeach
    </x-form-control>
</div>
