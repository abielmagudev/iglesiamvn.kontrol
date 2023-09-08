<div class="field">
    <label for="inputEdadMinimaFiltro" class="label">
        <span>Edades</span>
        <span class="has-text-weight-normal has-text-grey">(En años)</span>
    </label>
    <div class="columns">
        <div class="column">
            <x-form-control type="number" id="inputEdadMinimaFiltro" name="edad_minima" :value="$request->edad_minima" min="1" placeholder="Mínima o cualquiera edad..." />
        </div>
        <div class="column">
            <x-form-control type="number" id="inputEdadMaximaFiltro" name="edad_maxima" :value="$request->edad_maxima" min="1" placeholder="Máxima o cualquiera edad..." />
        </div>
    </div>
</div>