<?php

namespace Asdh\PasswordChangedNotification\Contracts;

use Illuminate\Mail\Mailable;

interface PasswordChangedNotificationContract
{
    public function passwordColumnName(): string;

    public function emailColumnName(): string;

    public function passwordChangedNotificationMail(): Mailable;

    public function isPasswordChanged(): bool;

    public function shouldPasswordChangedNotificationMailBeQueued(): bool;

    public function sendPasswordChangedNotification(): void;
}
