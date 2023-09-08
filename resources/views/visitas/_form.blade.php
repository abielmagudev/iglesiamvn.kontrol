@csrf
<div class="field">
    <label for="inputFecha" class="label">Fecha</label>
    <div class="control">
        <x-form-control type="date" id="inputFecha" name="fecha" :value="old('fecha', $visita->fecha_raw)" autofocus />
    </div>
    <x-help failed="fecha" />
</div>
<div class="field">
    <label for="inputNombre" class="label">Nombre</label>
    <div class="control">
        <x-form-control type="text" id="inputNombre" name="nombre" :value="old('nombre', $visita->nombre)" />
    </div>
    <x-help failed="nombre" />
</div>
<div class="field">
    <label for="textareaMediosContacto" class="label">Medios de contacto</label>
    <div class="control">
        <x-form-control type="textarea" id="textareaMediosContacto" name="medios_contacto" :value="old('medios_contacto', $visita->medios_contacto)" rows="2" />
    </div>
    <x-help failed="medios_contacto" />
</div>
<div class="field">
    <label for="textareaExplicacion" class="label">Explicación de su llegada</label>
    <div class="control">
        <x-form-control type="textarea" id="textareaExplicacion" name="explicacion" :value="old('explicacion', $visita->explicacion)" rows="4" />
    </div>
    <x-help failed="explicacion" />
</div>
<div class="field">
    <label for="textareaRespuestas" class="label">Respuestas al contactar</label>
    <div class="control">
        <x-form-control type="textarea" id="textareaRespuestas" name="respuestas" :value="old('respuestas', $visita->respuestas)" rows="4" />
    </div>
    <x-help failed="respuestas" />
</div>
