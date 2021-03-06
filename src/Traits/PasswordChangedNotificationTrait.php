<?php

namespace Asdh\PasswordChangedNotification\Traits;

use Asdh\PasswordChangedNotification\Mail\PasswordChangedNotificationMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

trait PasswordChangedNotificationTrait
{
    use ObservePasswordChanged;

    public function passwordColumnName(): string
    {
        return 'password';
    }

    public function emailColumnName(): string
    {
        return 'email';
    }

    public function nameColumnName(): string
    {
        return 'name';
    }

    public function passwordChangedNotificationMail(): Mailable
    {
        return new PasswordChangedNotificationMail($this);
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
