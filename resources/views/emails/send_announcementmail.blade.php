@component('mail::message')
Hello {{ $user->name }},

<p>{{ $user->description }}</p>

<p>Thanks,<br>
{{ config('app.name') }}</p>
@endcomponent