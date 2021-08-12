<?php

namespace Mawuekom\LaravelPasswordHistory;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mawuekom\LaravelPasswordHistory\Skeleton\SkeletonClass
 */
class LaravelPasswordHistoryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-password-history';
    }
}
