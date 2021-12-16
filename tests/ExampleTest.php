<?php

use Asdh\PasswordChangedNotification\Tests\Model\User;
use Illuminate\Support\Facades\Mail;

it('can send mail to the users when password is changed', function () {
    Mail::fake();

    $user = User::factory()->create();

    $user->password = bcrypt("password2");
    $user->save();

    Mail::assertSent($user->passwordChangedNotificationMail()::class);
});

it('will not send mail to the users when password is not changed', function () {
    Mail::fake();

    $user = User::factory()->create();

    $user->name = 'Laratips';
    $user->save();

    Mail::assertNotSent($user->passwordChangedNotificationMail()::class);
});
