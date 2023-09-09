<div class="box">
    <nav class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Eventos</p>
                <p class="title">{{ $counters->eventos }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">{{ nombreMesNumero( date('m') ) }}</p>
                <p class="title">{{ $eventos->filter(function ($evento) { return $evento->fecha->month == date('m'); })->count() }}</p>
            </div>
        </div>
    </nav>
</div>
