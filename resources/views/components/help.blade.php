<?php $setup = (object) [
    'slot' => $slot,
    'failed' => $failed ?? null,
    'hasFailed' => isset($failed) && $errors->has($failed),
] ?>

@error( $setup->failed )
<div class="help is-danger">
    <b>*</b> 
    <span>{{ $message }}</span>
</div>
@enderror

@if(! $setup->hasFailed && $setup->slot->isNotEmpty() )  
<div class="help">
    {!! $setup->slot !!}
</div>
@endif
