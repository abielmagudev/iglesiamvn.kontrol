<?php $setup = (object) [
    'content' => $slot ?? '',
    'footer' => $footer ?? '',
    'hasClose' => $close ?? false,
    'hasFooter' => isset($footer),
    'hasTitle' => isset($title),
    'id' => $id,
    'title' => $title ?? '',
] ?>

<div class="modal" id="{{ $setup->id }}">
    <div class="modal-background"></div>

    <div class="modal-card">
        @if( $setup->hasTitle || $setup->hasCloseButton )
        <header class="modal-card-head">
            <p class="modal-card-title">{{ $setup->title }}</p>

            @if( $setup->hasClose )
            <button class="delete" aria-label="close"></button>
            @endif

        </header>
        @endif

        <section class="modal-card-body">
            {!! $setup->content !!}
        </section>

        @if( $setup->hasFooter )          
        <footer class="modal-card-foot">
            {!! $setup->footer !!}
        </footer>
        @endif
    </div>

</div>
