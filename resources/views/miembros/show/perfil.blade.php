<x-card-image source="{{ asset( sprintf('images/%s.jpg', $miembro->clave_genero_biologico) ) }}" alt="Fotografia {{ $miembro->nombre_completo }}">
    <p class="title mb-3">{{ $miembro->nombre_completo }}</p>
    <p>
        <x-custom.tag-estatus-membresia :activo="$miembro->esActivo()" />
    </p>
    <hr>

    <p>
        <small class="has-text-danger">Emergencias:</small>
        <br>
        {{ $miembro->emergencias }}
    </p>
    <p>
        <small class="has-text-grey is-block">Móvil:</small>
        <span>{{ $miembro->numero_movil }}</span>
    </p>
    <p>
        <small class="has-text-grey is-block">Teléfono:</small>
        <span>{{ $miembro->numero_telefono }}</span>
    </p>
    <p>
        <small class="has-text-grey is-block">Correo electrónico:</small>
        <span>{{ $miembro->correo_electronico }}</span>
    </p>
    <p>
        <small class="has-text-grey is-block">Web:</small>
        <span>{!! $miembro->tieneWeb() ? convertirLinks($miembro->web) : '' !!}</span>
    </p>
    <hr>

    <p>
        <small class="has-text-grey is-block">Estado civil:</small>
        <span class="is-capitalized">{{ $miembro->estado_civil }}</span>
    </p>
    <p>
        <small class="has-text-grey is-block">Nacimiento:</small>
        @if( $miembro->tieneFechaNacimiento() )
        <span>{{ $miembro->fecha_nacimiento_humano }}</span>
        <span>({{ $miembro->edad_anios }})</span>
        @endif
        <span class="is-block is-capitalized">{{ $miembro->lugar_nacimiento }}</span>
    </p>
    <hr>
    
    <p>
        <small class="has-text-grey is-block">Domicilio:</small>
        <span class="is-capitalized is-block">{{ $miembro->direccion }}</span>
        <span class="is-capitalized">{{ $miembro->localidad }}</span>
    </p>  
    
    @if( $miembro->estaConviviendoDomicilio() )
    <p>
        <small class="has-text-grey is-block">Convive:</small>
        <span class="is-capitalized">
            <a href="{{ route('miembros.show', $miembro->conviveDomicilio->id) }}">{{ $miembro->conviveDomicilio->nombre_completo }}</a>
        </span>
    </p>                     
    @endif
    <hr>
    <p>
        <small class="has-text-grey is-block">Ocupaciones:</small>
        <span>{{ $miembro->ocupaciones }}</span>
    </p>
    <p>
        <small class="has-text-grey is-block">Notas:</small>
        <span>{{ $miembro->notas }}</span>
    </p>
    <p>
        <small class="has-text-grey is-block">Membresia:</small>
        <span>{{ $miembro->fecha_registro_humano }} ({{ $miembro->fecha_registro_diferencia }})</span>
    </p>

    <br>

    <a href="{{ route('miembros.edit', $miembro) }}" class="button is-warning is-fullwidth">Editar</a>
    <div class="field is-grouped is-grouped-right">
        <div class="control">
        </div>
        <div class="control is-hidden">
            <a href="{{ route('miembros.index') }}" class="button is-dark">Index</a>
        </div>
    </div>
</x-card-image>
