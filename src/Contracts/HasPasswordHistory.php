<?php

namespace Mawuekom\PasswordHistory\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasPasswordHistory
{
    /**
     * User has many password histories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passwordHistories(): HasMany;

    /**
     * Retrieve a number of recent passwords used.
     *
     * @param int $howMany
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function retrieveRecentPasswordsUsed(int $howMany): Collection;

    /**
     * Update password history entity.
     *
     * @return self
     */
    public function updatePasswordHistory(): self;
}