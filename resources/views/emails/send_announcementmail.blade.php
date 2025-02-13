@component('mail::message')
Hello {{ $user->name }},

{{  $user->description   }}



Thanks,
{{ config('app.name') }}
@endcomponent

