<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Auto-Observe Models
    |--------------------------------------------------------------------------
    |
    | This determines whether the package automatically applies the AuditObserver
    | to the listed models when the package is booted. You can turn this off and
    | manually register observers in your application's AppServiceProvider.
    |
    */
    'auto_observe' => true,

    /*
    |--------------------------------------------------------------------------
    | Models to Audit
    |--------------------------------------------------------------------------
    |
    | If auto_observe is true, the package will iterate through this array and
    | call ->observe(AuditObserver::class) for each. Make sure these are valid
    | Eloquent model classes.
    |
    */
    'models' => [
        \App\Models\User::class,
        // \App\Models\Post::class,
        // etc...
    ],

    /*
    |--------------------------------------------------------------------------
    | Redaction / Sensitive Fields
    |--------------------------------------------------------------------------
    |
    | Any fields listed here will be automatically redacted in the logs, meaning
    | the package will replace them with [REDACTED] before saving to the DB.
    |
    */
    'sensitive_fields' => [
        'password',
        'credit_card_number',
        // ...
    ],
];
