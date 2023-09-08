<div class="has-text-right">
    <x-modal-trigger modal-id="modalConfirmarEliminar" class="has-text-danger" link>
        <span>{{ $attributes->get('text') }}</span>
    </x-modal-trigger>
</div>

<x-modal id="modalConfirmarEliminar">
    <div class="box">
        <div class="has-text-centered">
            <p class='title'>Atención</p>
            {{ $slot }}
        </div>
        <br>
        <form action="{{ $attributes->get('route') }}" method="post">
            @csrf
            @method('delete')
            <div class="field is-grouped is-grouped-centered">
                <div class="control">
                    <button class="button is-danger is-outlined">Si, {{ strtolower($attributes->get('text')) }}</button>
                </div>
                <div class="control">
                    <button type="button" class="button is-dark button-modal-close">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</x-modal>
