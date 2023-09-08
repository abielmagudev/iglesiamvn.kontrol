@csrf
<div class="field">
    <label for="inputNombre" class="label">Nombre</label>
    <div class="control">
        <x-form-control type="text" id="inputNombre" name="nombre" :value="old('nombre', $evento->nombre)" autofocus />
    </div>
    <x-help failed="nombre" />
</div>
<div class="field">
    <label for="textareaDescripcion" class="label">Descripción</label>
    <div class="control">
        <x-form-control type="textarea" id="textareaDescripcion" name="descripcion" :value="old('descripcion', $evento->descripcion)" rows="4" />
    </div>
    <x-help failed="descripcion" />
</div>
<div class="field">
    <label for="inputFecha" class="label">Fecha</label>
    <div class="control">
        <x-form-control type="date" id="inputFecha" name="fecha" :value="old('fecha', $evento->fecha_raw)" />
    </div>
    <x-help failed="fecha" />
</div>
<div class="field">
    <label for="inputHora" class="label">Hora</label>
    <div class="control">
        <x-form-control type="time" id="inputHora" name="hora" :value="old('hora', $evento->hora_sin_segundos)" min='00:00' max='23:59' />
    </div>
    <x-help failed="hora" />
</div>
