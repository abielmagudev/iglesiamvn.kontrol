<?php $setup = (object) [
    'classes' => $class ?? '',
    'isLink' => isset($link),
    'modalId' => $modalId,
    'slot' => $slot ?? '',
] ?>

@if( $setup->isLink )
<a class="js-modal-trigger {{ $setup->classes }}" data-target="{{ $setup->modalId }}" {{ $attributes->except(['class', 'modal-id']) }} href="#!">
    {!! trim($setup->slot) !!}
</a>

@else
<button class="js-modal-trigger {{ $setup->classes }}" data-target="{{ $setup->modalId }}" {{ $attributes->except(['class', 'modal-id']) }}>
    {!! trim($setup->slot) !!}
</button>

@endif
