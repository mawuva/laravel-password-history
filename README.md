# Laravel Password History


This package allows to store users password history and check if the user can use the same for updating or not.
Then, you can tell your users when they will be going to create a new password for their accounts
if they can use an already used password or not.

## Installation

You can install the package via composer:

```bash
composer require mawuekom/laravel-password-history
```

## Usage

Once install, go to `config/app.php` to add `PasswordHistoryServiceProvider` in providers array

 Laravel 5.5 and up Uses package auto discovery feature, no need to edit the `config/app.php` file.

 - #### Service Provider

```php
'providers' => [

    ...

    Mawuekom\PasswordHistory\PasswordHistoryServiceProvider::class,

],
```

- #### Publish Assets

```bash
php artisan vendor:publish --tag=password-history
```

Or you can publish config

```bash
php artisan vendor:publish --tag=password-history --config
```

#### Configuration

* You can change connection for models, models path and there is also a handy pretend feature.
* There are many configurable options which have been extended to be able to configured via `.env` file variables.
* Editing the configuration file directly may not needed because of this.
* See config file: [password-history.php](https://github.com/mawuva/laravel-password-history/blob/main/config/password-history.php).

```php
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
    | Add uuid support
    |--------------------------------------------------------------------------
    */

    'uuids' => [
        'enable' => true,
        'column' => '_id'
    ],
];
```

- #### HasPasswordHistory Trait and Contract

To allow your users to use password histries, add   `HasPasswordHistory` trait in your User Model.

```php
<?php

namespace App\Models;

...
use Mawuekom\PasswordHistory\Traits\HasPasswordHistory;
...

class User extends Authenticatable
{
    use HasPasswordHistory;

    ...
}
```


- #### PasswordHistoryChecker Service

`PasswordHistoryChecker` is a service that help you implement the fact that an user can not use recently used passwords for creating a new one. If he do so, it will be notify that : 

 `Your new password can not be the same as any of your recent passwords. Please choose a new password.`

- #### When you new user is created, you can store his password

```php
$user = User::create([
    'name'      => 'Toto',
    'email'     => 'toto@gmail.com',
    'password'  => 'toto1234',
]);

$user ->updatePasswordHistory();
```

- #### When user wants to change his password

```php
$user = User::find(1);

PasswordHistoryChecker::validatePassword($user, $new_password);
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

