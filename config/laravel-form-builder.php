<?php

return [
    'defaults'      => [
        'wrapper_class'       => 'form-group row',
        'wrapper_error_class' => 'has-error',
        'label_class'         => 'col-sm-3 col-form-label text-right',
        'field_class'         => 'col-sm-8 form-control',
        'field_error_class'   => '',
        'help_block_class'    => 'help-block',
        'error_class'         => 'text-danger',
        'required_class'      => 'required',

        // Override a class from a field.
        // 'text'                => [
        //    'wrapper_class'   => 'form-field-text',
        //    'label_class'     => 'form-field-text-label',
        //    'field_class'     => 'form-field-text-field',
        // ],
        // 'choice'               => [
        //     'wrapper_class'   => 'form-group row mt-2',
        // ],
        'radio'               => [
            'wrapper_class'   => 'form-radio mt-2',
            'label_class'     => 'form-radio-label mr-4 ml-1 mt-2',
            'field_class'     => 'form-radio-field mt-2',
           // 'choice_options'  => [
           //     'wrapper'     => ['class' => 'form-radio'],
           //     'label'       => ['class' => 'form-radio-label'],
           //     'field'       => ['class' => 'form-radio-field mx-2'],
           // ]
        ],
    ],
    // Templates
    'form'          => 'laravel-form-builder::form',
    'text'          => 'laravel-form-builder::text',
    'textarea'      => 'laravel-form-builder::textarea',
    'button'        => 'laravel-form-builder::button',
    'buttongroup'   => 'laravel-form-builder::buttongroup',
    'radio'         => 'laravel-form-builder::radio',
    'checkbox'      => 'laravel-form-builder::checkbox',
    'select'        => 'laravel-form-builder::select',
    'choice'        => 'laravel-form-builder::choice',
    'repeated'      => 'laravel-form-builder::repeated',
    'child_form'    => 'laravel-form-builder::child_form',
    'collection'    => 'laravel-form-builder::collection',
    'static'        => 'laravel-form-builder::static',

    // Remove the laravel-form-builder:: prefix above when using template_prefix
    'template_prefix'   => '',

    'default_namespace' => '',

    'custom_fields' => [
//        'datetime' => App\Forms\Fields\Datetime::class
    ]
];
