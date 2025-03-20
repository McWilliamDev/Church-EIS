@component('mail::message')
Hello {{ $user->name }},

<p>It seems like you forgot your password for New Ground Generation Church. If this is true, click the button below to reset your password:</p>

<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <a href="{{ url('reset/' . $user->remember_token) }}" style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                Reset Your Password
            </a>
        </td>
    </tr>
</table>

<p>If you did not forget your password, you can safely ignore this email.</p>

Thanks,

{{ config('app.name') }}
@endcomponent