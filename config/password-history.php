<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    
    /**
     * Password histories config
     */
    
    'enable'                    => true,
    'model'                     => Mawuekom\PasswordHistory\Models\PasswordHistory::class,
    'checker'                   => false,
    'number_to_check'           => 3,
    'name'                      => 'Password History',
    'resource_name'             => 'password_history',

    'table'                     => [
        'name'                  => env('PASSWORD_HISTORY_PASSWORD_HISTORIES_DATABASE_TABLE', 'password_histories'),
        'primary_key'           => env('PASSWORD_HISTORY_PASSWORD_HISTORIES_DATABASE_TABLE_PRIMARY_KEY', 'id'),
        'user_foreign_key'      => env('PASSWORD_HISTORY_PASSWORD_HISTORIES_DATABASE_TABLE_USER_FOREIGN_KEY', 'user_id'),
    ],

    /**
     * Users config
     */
    'user' => [
        'model'             => App\Models\User::class,
        'name'              => 'User',
        'resource_name'     => 'user',

        'table'     => [
            'name'          => env('PASSWORD_HISTORY_USERS_DATABASE_TABLE', 'users'),
            'primary_key'   => env('PASSWORD_HISTORY_USERS_DATABASE_TABLE_PRIMARY_KEY', 'id'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password changed tracker
    |--------------------------------------------------------------------------
    */
    'password_changed_tracker' => [
        'enable'    => true,
        'column' => [
            'name'      => 'password_changed_at',
            'type'      => 'timestamp'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Add uuid support
    |--------------------------------------------------------------------------
    */

    'uuids' => [
        'enable' => true,
        'column' => '_id'
    ],
];