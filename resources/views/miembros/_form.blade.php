@csrf
<p class="has-text-grey">Membresia</p>

{{-- Seleccion de activo --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="selectActivo" class="label">Activo</label>
    </x-slot>

    <div class="field">
        <div class="control">
            <x-form-control type="select" id="selectActivo" class="is-fullwidth" name="activo" required>
                <?php $old_activo = old('activo', $miembro->activo) ?>
                <option value="1" {{ isSelected( $old_activo == 1 || is_null($miembro->id) ) }}>Si ha solicitado la membresia</option>
                <option value="0" {{ isSelected( $old_activo == 0 &&! is_null($old_activo) ) }}>No ha solicitado ó retiro la membresia</option>
            </x-form-control>
        </div>
        <x-help failed="activo" />
    </div>
</x-field-horizontal>

{{-- Fecha de registro --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputFechaRegistro" class="label">Fecha de registro</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="date" id="inputFechaRegistro" name='fecha_registro' :value="old('fecha_registro', $miembro->fecha_registro_raw) ?? date('Y-m-d')" placeholder="(Opcional) Selecciona la fecha de registro" required />
        </div>
        <x-help failed="fecha_registro" />
    </div>
</x-field-horizontal>

<br>
<p class="has-text-grey">Personal</p>

{{-- Nombres --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputNombres" class='label'>Nombre(s)</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="text" id="inputNombres" name="nombres" :value="old('nombres', $miembro->nombres)" placeholder="Escribe el nombre(s)" required autofocus />
        </div>
        <x-help failed="nombres" />
    </div>
</x-field-horizontal>

{{-- Apellidos --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputApellidos" class='label'>Apellido(s)</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="text" id="inputApellidos" name="apellidos" :value="old('apellidos', $miembro->apellidos)" placeholder="Escribe el apellido(s)" required />
        </div>
        <x-help failed="apellidos" />
    </div>
</x-field-horizontal>

{{-- Genero --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="checkboxGenero" class='label'>Género</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="boxed" validated="genero">
                <label class="radio">
                    <input type="radio" name="genero" value="f" {{ isChecked( is_null($miembro->clave_genero_biologico) || old('genero', $miembro->clave_genero_biologico) == 'f' ) }}>
                    <span>Femenino</span>
                </label>
                <span class="mx-3"></span>
                <label class="radio">
                    <input type="radio" name="genero" value="m" {{ isChecked( old('genero', $miembro->clave_genero_biologico) == 'm' ) }}>
                    <span>Masculino</span>
                </label>
            </x-form-control>
        </div>
        <x-help failed="genero" />
    </div>
</x-field-horizontal>

{{-- Fecha de nacimiento --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputFechaNacimiento" class='label'>Fecha de nacimiento</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="date" id="inputFechaNacimiento" name='fecha_nacimiento' :value="old('fecha_nacimiento', ($miembro->tieneFechaNacimiento() ? $miembro->fecha_nacimiento_raw : null))" placeholder="(Opcional) Selecciona la fecha de nacimiento" />
        </div>
        <x-help failed="fecha_nacimiento" />
    </div>
</x-field-horizontal>

{{-- Lugar de nacimiento --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputLugarNacimiento" class='label'>Lugar de nacimiento</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="text" id='inputLugarNacimiento' name='lugar_nacimiento' :value="old('lugar_nacimiento', $miembro->lugar_nacimiento)" placeholder="(Opcional) Ej. {{ $predeterminados->localidad }}" list="localidadesPredeterminadas" />
        </div>
        <x-help failed="lugar_nacimiento" />
    </div>
</x-field-horizontal>

{{-- Estado civil --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="selectEstadoCivil" class="label">Estado civil</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="select" id="selectEstadoCivil" class="is-fullwidth" name="estado_civil">
                <option disabled selected label="(Opcional) Selecciona..."></option>
                @foreach($predeterminados->estados_civiles as $estado_civil)
                <option value="{{ $estado_civil }}" {{ isSelected( old('estado_civil', $miembro->estado_civil_raw) == $estado_civil ) }}>{{ ucfirst($estado_civil) }}(a)</option>
                @endforeach
            </x-form-control>
        </div>
        <x-help failed="estado_civil" />
    </div>
</x-field-horizontal>

<br>
<p class="has-text-grey">Domicilio</p>

{{-- Domicilio personal o convive con miembro --}}
<x-field-horizontal>
    <x-slot name="label">&nbsp;</x-slot>
    <div style="width:100%">
        <label for="checkboxDomicilioMiembro" class="checkbox">
            <input id="checkboxDomicilioMiembro" type="checkbox" class="checkbox" name="domicilio_miembro" value="{{ old('domicilio_miembro', $miembro->domicilio_miembro_id) }}" {{ isChecked( is_numeric( old('domicilio_miembro', $miembro->domicilio_miembro_id) ) ) }}>
            <b>Convive en el domicilio de un miembro(principal)</b>
            <small class="is-block ml-4">Al actualizar el domicilio del miembro principal, tambien se actualizará los miembros relacionados</small>
        </label>

        {{-- Web component GetMiembroClicked --}}
        @include('web-components.GetMiembroClicked')
        
    </div>
</x-field-horizontal>

{{-- Direccion --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputDireccion" class="label">Dirección</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="text" id="inputDireccion" name="direccion" :value="old('direccion', $miembro->direccion)" placeholder="(Opcional) Escribe el nombre de la calle, número, colonia, código postal..." />
        </div>
        <x-help failed="direccion" />
    </div>
</x-field-horizontal>

{{-- Localidad --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputLocalidad" class="label">Localidad</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="text" id="inputLocalidad" name="localidad" :value="old('localidad', $miembro->localidad)" placeholder="(Opcional) Ej. {{ $predeterminados->localidad }}" list="localidadesPredeterminadas" />
        </div>
        <x-help failed="localidad" />
    </div>
</x-field-horizontal>

<br>
<p class="has-text-grey">Contactar</p>

{{-- Medios de contacto --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="inpuNumeroMovil" class="label">Móvil</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="text" id="inpuNumeroMovil" name="numero_movil" :value="old('numero_movil', $miembro->numero_movil)" placeholder="(Opcional) Ej. Escribe el número de celular personal" />
        </div>
        <x-help failed="numero_movil" />
    </div>
</x-field-horizontal>
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputNumeroTelefono" class="label">Teléfono</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="text" id="inputNumeroTelefono" name="numero_telefono" :value="old('numero_movil', $miembro->numero_telefono)" placeholder="(Opcional) Ej. Escribe el número de teléfono de casa" />
        </div>
        <x-help failed="numero_telefono" />
    </div>
</x-field-horizontal>
<x-field-horizontal>
    <x-slot name="label">
        <label for="inputCorreoElectronico" class="label">Correo electrónico</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="text" id="inputCorreoElectronico" name="correo_electronico" :value="old('correo_electronico', $miembro->correo_electronico)" placeholder="(Opcional) Ej. Escribe el email personal" />
        </div>
        <x-help failed="correo_electronico" />
    </div>
</x-field-horizontal>
<x-field-horizontal>
    <x-slot name="label">
        <label for="textareaWeb" class="label">Web</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="textarea" id="textareaWeb" name="web" placeholder="(Opcional) Escribe redes sociales, sitios web... separados por filas" rows="2">
                {{ old('web', $miembro->web) }}
            </x-form-control>
        </div>
        <x-help failed="web" />
    </div>
</x-field-horizontal>

<br>
<p class="has-text-grey">Adicional</p>

{{-- Emergencias --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="textareaEmergencias" class="label">Emergencias</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="textarea" id="textareaEmergencias" name="emergencias" placeholder="(Opcional) Recomendaciones y medios de contacto para notificar alguna emergencia..." rows="2">
                {{ old('emergencias', $miembro->emergencias) }}
            </x-form-control>
        </div>
        <x-help failed="emergencias" />
    </div>
</x-field-horizontal>

{{-- Ocupaciones --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="textareaOcupaciones" class="label">Ocupaciones</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="textarea" id="textareaOcupaciones" name="ocupaciones" placeholder="(Opcional) Profesiones, actividades empresariales ó empleos..." rows="2">
                {{ old('ocupaciones', $miembro->ocupaciones) }}
            </x-form-control>
        </div>
        <x-help failed="ocupaciones" />
    </div>
</x-field-horizontal>

{{-- Notas --}}
<x-field-horizontal>
    <x-slot name="label">
        <label for="textareaNotas" class="label">Notas</label>
    </x-slot>
    <div class="field">
        <div class="control">
            <x-form-control type="textarea" id="textareaNotas" name="notas" placeholder="(Opcional) Información extra ó comentarios..." rows="2">
                {{ old('notas', $miembro->notas) }}
            </x-form-control>
        </div>
    </div>
</x-field-horizontal>

<datalist id="localidadesPredeterminadas">
    @foreach($predeterminados->localidades as $localidad)
    <option value="{{ $localidad }}"></option>
    @endforeach
</datalist>

@push('scripts')       
<script>
    @if( $miembro->estaConviviendoDomicilio() )
    GetMiembroClicked.inputValue("<?= $miembro->conviveDomicilio->nombre_completo ?>")
    @endif

    // Checkbox toggle for GetMiembroClicked
    let checkboxDomicilioMiembro = document.getElementById('checkboxDomicilioMiembro')
    checkboxDomicilioMiembro.addEventListener('change', (e) => GetMiembroClicked.display( e.target.checked ))
    GetMiembroClicked.display( checkboxDomicilioMiembro.checked )

    // Setup GetMiembroClicked
    let inputDireccion = document.getElementById('inputDireccion')
    let inputLocalidad = document.getElementById('inputLocalidad')
    GetMiembroClicked.listen(function (miembro) {
        checkboxDomicilioMiembro.value = miembro.id
        inputDireccion.value = miembro.direccion
        inputLocalidad.value = miembro.localidad
    })
</script>
@endpush
