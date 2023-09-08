<?php $setup = (object) [
    'types' => ['success', 'warning', 'danger', 'info', 'dark'],
] ?>

@foreach($setup->types as $notification)
    @if( session()->has($notification) )

    <div class="notification has-text-centered {{ $attributes->get('class', '') }} is-{{ $notification }}">
        <button class="delete"></button>
        {!! session()->get($notification) !!}
    </div>

    @endif
@endforeach
