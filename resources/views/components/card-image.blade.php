<?php $setup = (object) [
    'alt' => $alt ?? '',
    'content' => $slot ?? null,
    'footer' => $footer ?? '',
    'hasContent' => $slot->isNotEmpty(),
    'hasFooter' => isset($footer),
    'source' => $source,
] ?>

<div class="card">
    {{-- Image --}}
    <div class="card-image">
        <figure class="image is-4by3">
            <img src="{{ $setup->source }}" alt="{{ $setup->alt }}">
          </figure>
    </div>

    {{-- Content --}}
    @if( $setup->hasContent )
    <div class="card-content">
        <div class="content">
            {!! $setup->content !!}
        </div>
    </div>
    @endif

    {{-- Footer --}}
    @if( $setup->hasFooter )        
    <footer class="card-footer">
        {!! $setup->footer !!}
    </footer>
    @endif
</div>
