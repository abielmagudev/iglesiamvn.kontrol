<?php $setup = (object) [
    'content' => $slot ?? '',
    'hasIconClose' => $iconClose ?? false,
    'id' => $id,
] ?>
<div class="modal" id="{{ $setup->id }}">
    <div class="modal-background"></div>

    <div class="modal-content px-3">
        {!! $setup->content !!}
    </div>

    @if( $setup->hasIconClose )
    <button class="modal-close is-large" aria-label="close"></button>
    @endif

</div>
