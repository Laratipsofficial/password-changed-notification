@component('mail::message')
Hi {{ $user->getRawOriginal($user->nameColumnName()) }},

The password for your account was recently changed.

Please contact {{ config('app.name') }} team if you did not initiate this change.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
