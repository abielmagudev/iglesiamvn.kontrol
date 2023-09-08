@if( $visitas->count() )
<div class="box">
    <nav class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Visitas</p>
                <p class="title">{{ $counters->visitas }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Si atendidas</p>
                <p class="title">{{ $counters->visitas_si_atendidas }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">No atendidas</p>
                <p class="title">{{ $counters->visitas_no_atendidas }}</p>
            </div>
        </div>
      </nav>
</div>
@endif
