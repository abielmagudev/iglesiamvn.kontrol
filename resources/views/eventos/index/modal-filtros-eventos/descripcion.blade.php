<div class="field">
    <label for="selectDescripcionFiltro" class="label">Descripción</label>
    <x-form-control type="select" id="selectDescripcionFiltro" class="is-fullwidth" name="descripcion">
        <option value="cualquiera" {{ isSelected( !in_array($request->descripcion, ['0', '1']) ) }}>Cualquiera</option>
        <option value="1" {{ isSelected( ($request->descripcion == '1') ) }}>Con descripción</option>
        <option value="0" {{ isSelected( ($request->descripcion == '0') ) }}>Sin descripción</option>
    </x-form-control>
</div>
