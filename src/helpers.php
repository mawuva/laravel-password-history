<?php

use Illuminate\Support\Facades\Schema;

if (!function_exists('password_changed_is_enabled_and_exists')) {
    /**
     * Check if password cganged is enabled and exists in schema.
     * 
     * @return bool
     */
    function password_changed_is_enabled_and_exists(): bool {
        $table = config('password-history.user.table.name');
        $password_changed_enabled = config('password-history.password_changed_tracker.enable');
        $password_changed_column_name = config('password-history.password_changed_tracker.column.name');

        return ($password_changed_enabled && Schema::hasColumn($table, $password_changed_column_name))
                ? true
                : false;
    }
}