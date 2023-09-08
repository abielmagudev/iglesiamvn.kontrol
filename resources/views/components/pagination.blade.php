<?php $links = [
    'pagination-previous' => [
        'link' => $collection->previousPageUrl(),
        'text' => 'Anterior',
    ],
    'pagination-next' => [
        'link' => $collection->nextPageUrl(),
        'text' => 'Siguiente',
    ],
] ?>

<nav class="pagination is-left" role="navigation" aria-label="pagination">
    @foreach($links as $class => $props)
    @if(! is_null($props['link']) )
    <a class="{{ $class }} button is-link is-outlined" href="{{ $props['link'] }}">{{ $props['text'] }}</a>
        
    @else
    <span class="{{ $class }} " disabled>{{ $props['text'] }}</span>

    @endif
    @endforeach
    
    <ul class="pagination-list"></ul>
</nav>
