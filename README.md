# Password Changed Notification

[![Latest Version on Packagist](https://img.shields.io/packagist/v/asdh/password-changed-notification.svg?style=flat-square)](https://packagist.org/packages/asdh/password-changed-notification)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/asdh/password-changed-notification/run-tests?label=tests)](https://github.com/asdh/password-changed-notification/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/asdh/password-changed-notification/Check%20&%20fix%20styling?label=code%20style)](https://github.com/asdh/password-changed-notification/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/asdh/password-changed-notification.svg?style=flat-square)](https://packagist.org/packages/asdh/password-changed-notification)

A simple package to send mail notification to the user when their password is changed.

## Installation

You can install the package via composer:

```bash
composer require asdh/password-changed-notification
```

## Usage

After installing the package, you can go to your `User` model or any other model that has password and email fields and use `PasswordChangedNotificationTrait` trait and implement `PasswordChangedNotificationContract` interface

```php
use Asdh\PasswordChangedNotification\Contracts\PasswordChangedNotificationContract;
use Asdh\PasswordChangedNotification\Traits\PasswordChangedNotificationTrait;

class User extends Authenticatable implements PasswordChangedNotificationContract
{
    use PasswordChangedNotificationTrait;
}
```

Now whenever you change the password of the user, a mail will be automatically sent to that user. Isn't that easy.

By default the package will assume the columns name to be `email` and `password`. But if you have different column name for those fields then you can modify those as well.

Let's say you have the `email` column as `user_email` in your `User` model or any other model, then you can add `emailColumnName` method on the `User` model and return `user_email` from here like so:

```php
public function emailColumnName(): string
{
    return 'user_email';
}
```

You can also modify the `password` column by adding this method.

```php
public function passwordColumnName(): string
{
    return 'user_password';
}
```

You can also modify the `name` column by adding this method. This will be used in the mail like Hi `Adam`.

```php
public function nameColumnName(): string
{
    return 'full_name';
}
```

Further, if you want to modify the mail that is being sent to the user, you can publish the mail view using

```bash
php artisan vendor:publish --tag="password-changed-notification-views"
```

The views view will now be published in `resources/views/vendor/password-changed-notification/emails/password-changed-notification.blade.php`. You can modify this file as per your need and when mail is sent to the user, it will be used.

You can also create your own mailable (the one that you create using `php artisan make:mail` command) and use that instead. For that you need to return the mailable that you have created by adding `passwordChangedNotificationMail` method on the `User` model and returning the mailable.

```php
public function passwordChangedNotificationMail(): Mailable
{
    return new YourOwnPasswordChangedNotificationMail($this);
}
```

## Testing

```bash
composer test
```

## Credits

-   [Laratips](https://github.com/Laratipsofficial)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
