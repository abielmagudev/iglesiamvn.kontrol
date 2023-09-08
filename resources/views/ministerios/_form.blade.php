<div class="field">
    <label for="inputNombre" class="label">Nombre</label>
    <div class="control">
        <x-form-control type="text" id="inputNombre" name="nombre" :value="old('nombre', $ministerio->nombre)" required autofocus />
    </div>
    <x-help failed="nombre" />
</div>

<div class="field">
    <label for="textareaDescripcion" class="label">Descripción</label>
    <div class="control">
        <x-form-control type="textarea" id="textareaDescripcion" name="descripcion" placeholder="(Opcional)">
            {{ old('descripcion', $ministerio->descripcion) }}
        </x-form-control>
    </div>
</div>
@csrf
