<?php $setup = (object) [
    'field_body' => $slot ?? '',
    'field_label' => $label ?? '',
    'hasFieldLabel' => isset($label),
    'id' => $id ?? '',
] ?>

<div class="field is-horizontal" id="{{ $setup->id }}">

    @if( $setup->hasFieldLabel )       
    <div class="field-label is-normal">
        {!! $setup->field_label !!}
    </div>
    @endif

    <div class="field-body">
        {!! $setup->field_body !!}
    </div>
</div>
