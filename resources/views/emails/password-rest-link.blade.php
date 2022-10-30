@component('mail::message')

Hi There,

You have requested for password reset link.
Please reset your password by clicking on the below link.


@component('mail::button', ['url' => route('reset.passwords', $token)])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
