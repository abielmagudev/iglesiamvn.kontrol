<?php $setup = (object) [
    'type' => $type,
    'isNotInput' => in_array($type, [
        'boxed',
        'checkbox',
        'file',
        'radio',
        'select',
        'textarea',
    ]),
    'classes' => implode(' ', [
        $attributes->get('class', ''),
        $errors->has( ($attributes->get('name') ?? $attributes->get('validated')) ) ? 'is-danger' : '',
    ]),
    'childClasses' => $attributes->get('childClasses', ''),
    'attributes' => $attributes->except([
        'class',
        'parentClasses',
        'validated',
        'value',
    ]),
    'value' => $attributes->get('value', $slot) ?? null,
] ?>

@if( $setup->isNotInput )
@include('components.form-controls.' . $setup->type)

@else
@include('components.form-controls.input')

@endif
