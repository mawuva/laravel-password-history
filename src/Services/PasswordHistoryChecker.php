<?php

namespace Mawuekom\PasswordHistory\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordHistoryChecker
{
    /**
     * Validate password
     *
     * @param \Illuminate\Database\Eloquent\Model $user
     * @param string $password
     *
     * @return void
     */
    public static function validatePassword(Model $user, string $password): void
    {
        $password_history_enabled           = config('password-history.enable');
        $password_history_checker_enabled   = config('password-history.checker');
        $passwords_number_to_check          = config('password-history.number_to_check');

        if ($password_history_enabled && $password_history_checker_enabled) {
            $recentPasswordsUsed = $user ->retrieveRecentPasswordsUsed($passwords_number_to_check);

            foreach ($recentPasswordsUsed as $recentPassword) {
                if (Hash::check($password, $recentPassword ->password)) {
                    throw ValidationException::withMessages([
                        'password'      => trans('password-history::messages.can_not_use_same_password'),
                        'new_password'  => trans('password-history::messages.can_not_use_same_password'),
                    ]);
                }
            }
        }
    }
}