<?php $setup = (object) [
    'body' => $slot,
    'classes' => $attributes->get('class', ''),
    'hasHead' => isset($head),
    'head' => $head ?? null,
] ?>
<div class="table-container">
    <table class="table {{ $setup->classes }}">
        @if( $setup->hasHead )        
        <thead>
            {!! $setup->head !!}
        </thead>
        @endif

        <tbody>
            {!! $setup->body !!}
        </tbody>
    </table>
</div>
