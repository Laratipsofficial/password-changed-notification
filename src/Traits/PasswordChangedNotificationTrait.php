<?php

namespace Asdh\PasswordChangedNotification\Traits;

use Asdh\PasswordChangedNotification\Mail\PasswordChangedNotificationMail;
use Asdh\PasswordChangedNotification\Observers\PasswordChangedObserver;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

trait PasswordChangedNotificationTrait
{
    public static function booted()
    {
        static::observe(PasswordChangedObserver::class);
    }

    public function passwordColumnName(): string
    {
        return 'password';
    }

    public function emailColumnName(): string
    {
        return 'email';
    }

    public function passwordChangedNotificationMail(): Mailable
    {
        return new PasswordChangedNotificationMail();
    }

    public function isPasswordChanged(): bool
    {
        return $this->wasChanged($this->passwordColumnName());
    }

    public function shouldPasswordChangedNotificationMailBeQueued(): bool
    {
        return false;
    }

    public function sendPasswordChangedNotification(): void
    {
        if (! $this->isPasswordChanged()) {
            return;
        }

        $mail = Mail::to($this->getRawOriginal($this->emailColumnName()));

        if ($this->shouldPasswordChangedNotificationMailBeQueued()) {
            $mail->queue($this->passwordChangedNotificationMail());

            return;
        }

        $mail->send($this->passwordChangedNotificationMail());
    }
}
