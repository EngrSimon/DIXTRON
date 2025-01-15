@component('mail::message')
<img src="{{ asset('/assets/img/logo/navabar.png') }}" alt="Company Logo" style="max-width: 200px; margin-bottom: 20px;">

# Reset Your Password

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => route('password.reset', $token), 'color' => '#ff6600'])
Reset Password
@endcomponent

If you did not request a password reset, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
