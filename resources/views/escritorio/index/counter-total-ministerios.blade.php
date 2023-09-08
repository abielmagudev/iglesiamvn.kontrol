@if( $ministerios->count() )
<div class="box">
    <nav class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Ministerios</p>
                <p class="title">{{ $counters->ministerios }}</p>
            </div>
        </div>
        <div class="level-item has-text-centered">
            <div>
                <p class="heading">Con más miembros</p>
                <p class="title is-text-ellipsis" style="width: 240px">{{ $ministerios->first()->nombre }}</p>
            </div>
        </div>
      </nav>
</div>    
@endif
