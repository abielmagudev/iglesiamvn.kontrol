<?php $setup = [
    'Cualquiera' => [
        'value' => 'cualquiera',
        'selected' => ! in_array($request->membresia, ['0','1']),
    ],
    'Activa' => [
        'value' => '1',
        'selected' => $request->membresia == 1,      
    ],
    'Inactiva' => [
        'value' => '0',
        'selected' => ctype_digit($request->membresia) && $request->membresia == 0,      
    ],
] ?>

<div class="field">
    <label for="selectMembresiaFiltro" class="label">Membresia</label>
    <x-form-control type="select" class="is-fullwidth" id="selectMembresiaFiltro" name="membresia">
        @foreach($setup as $text => $props)
        <option value="{{ $props['value'] }}" {{ isSelected($props['selected']) }}>{{ $text }}</option>
        @endforeach
    </x-form-control>
</div>
