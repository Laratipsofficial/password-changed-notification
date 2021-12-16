<?php

namespace Asdh\PasswordChangedNotification\Observers;

use Asdh\PasswordChangedNotification\Contracts\PasswordChangedNotificationContract;

class PasswordChangedObserver
{
    public function updated(PasswordChangedNotificationContract $model)
    {
        $model->sendPasswordChangedNotification();
    }
}
