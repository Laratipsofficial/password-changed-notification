<?php

namespace Asdh\PasswordChangedNotification\Traits;

use Asdh\PasswordChangedNotification\Observers\PasswordChangedObserver;

trait ObservePasswordChanged
{
    public static function bootObservePasswordChanged(): void
    {
        static::observe(PasswordChangedObserver::class);
    }
}
