<?php

namespace Mawuekom\PasswordHistory;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mawuekom\PasswordHistory\Skeleton\SkeletonClass
 */
class PasswordHistoryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'password-history';
    }
}
