@component('mail::message')

Hi {{$name}},

Your account has been created successfully.
Here are the credentails.

<br>
Username: {{$email}} <br>
Password : {{$password}} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
