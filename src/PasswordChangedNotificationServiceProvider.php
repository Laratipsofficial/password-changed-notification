<?php

namespace Asdh\PasswordChangedNotification;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Asdh\PasswordChangedNotification\Commands\PasswordChangedNotificationCommand;

class PasswordChangedNotificationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('password-changed-notification')
            ->hasViews();
    }
}
