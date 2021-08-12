<?php

namespace Mawuekom\PasswordHistory\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPasswordHistory
{
    /**
     * User has many password histories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwordHistories(): HasMany
    {
        $password_history_model = config('password-history.model');
        $password_histories_table_user_fk = config('password-history.table.user_foreign_key');
        $users_table_pk = config('password-history.user.table.primary_key');

        return $this ->hasMany($password_history_model, $password_histories_table_user_fk, $users_table_pk);
    }

    /**
     * Retrieve a number of recent passwords used.
     *
     * @param int $howMany
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function retrieveRecentPasswordsUsed(int $howMany): Collection
    {
        return $this ->passwordHistories() ->latest() ->take($howMany) ->get();
    }

    /**
     * Update password history entity.
     *
     * @return self
     */
    public function updatePasswordHistory(): self
    {
        $this ->passwordHistories() ->create(['password' => $this->password]);

        return $this;
    }
}