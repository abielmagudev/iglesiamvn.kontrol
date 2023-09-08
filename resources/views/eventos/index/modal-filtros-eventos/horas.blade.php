<div class="field">
    <label for="inputHoraMinimaFiltro" class="label">
        <span>Horas</span>
        <span class="has-text-weight-normal has-text-grey">(Mínima - Máxima)</span>
    </label>
    <div class="columns">
        <div class="column">
            <x-form-control type="time" id="inputHoraMinimaFiltro" name="hora_minima" :value="$request->hora_minima" placeholder="Mínima o cualquiera hora..." />
        </div>
        <div class="column">
            <x-form-control type="time" id="inputHoraMaximaFiltro" name="hora_maxima" :value="$request->hora_maxima" placeholder="Máxima o cualquiera hora..." />
        </div>
    </div>
</div>