<div class="field">
    <label for="selectRespuestasFiltro" class="label">Respuestas(atención)</label>
    <x-form-control type="select" id="selectRespuestasFiltro" class="is-fullwidth" name="respuestas">
        <option value="cualquiera" {{ isSelected( !in_array($request->respuestas, ['0', '1']) ) }}>Cualquiera</option>
        <option value="1" {{ isSelected( ($request->respuestas == '1') ) }}>Si atendidas</option>
        <option value="0" {{ isSelected( ($request->respuestas == '0') ) }}>No atendidas</option>
    </x-form-control>
</div>
