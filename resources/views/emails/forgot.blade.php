@component('mail::message')
    Hello {{ $user->name }},

    <p>Seems like you forgot your password for New Ground Generation Church. If this is true, click the button below to
        reset
        your password</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset Your Password
    @endcomponent

    <p>If you did not forgot your password you can safely ignore this email.</p>

    Thanks,

    {{ config('app.name') }}
@endcomponent
