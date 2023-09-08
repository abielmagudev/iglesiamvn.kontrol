<div class="box has-background-primary has-text-centered">
    <div class="title has-text-white is-uppercase">
        <b>{{ $miembro->fecha_nacimiento->day }} {{ nombreMesNumero( date('m') ) }}</b>
        <x-icons.cake />
    </div>
    <div class="subtitle has-text-white is-uppercase">
        <span>Hoy es su cumpleaños</span>
    </div>
</div>
