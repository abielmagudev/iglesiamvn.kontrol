<div class="field">
    <label for="inputFechaMinimaFiltro" class="label">
        <span>Fechas</span>
        <span class="has-text-weight-normal has-text-grey">(Mínima - Máxima)</span>
    </label>
    <div class="columns">
        <div class="column">
            <x-form-control type="date" id="inputFechaMinimaFiltro" name="fecha_minima" :value="$request->fecha_minima" placeholder="Mínima o cualquiera fecha..." />
        </div>
        <div class="column">
            <x-form-control type="date" id="inputFechaMaximaFiltro" name="fecha_maxima" :value="$request->fecha_maxima" placeholder="Máxima o cualquiera fecha..." />
        </div>
    </div>
</div>