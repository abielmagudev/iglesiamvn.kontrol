<?php $setup = (object) [
    'content' => $slot ?? '',
    'footer' => $footer ?? '',
    'hasContent' => $slot->isNotEmpty(),
    'hasFooter' => isset($title),
    'hasOptions' => isset($options),
    'hasTitle' => isset($title),
    'options' => $options ?? '',
    'title' => $title ?? '',
] ?>

<div class="card">
    {{-- Header --}}
    @if( $setup->hasTitle || $setup->hasOptions )           
    <header class="card-header">
        @if( $setup->hasTitle )
        <span class='card-header-title is-uppercase'>
            {!! $setup->title !!}
        </span>           
        @endif

        @if( $setup->hasOptions )
        <span class="card-header-icon">
            {!! $setup->options !!}
        </span>
        @endif
    </header>
    @endif

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
