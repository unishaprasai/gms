@component('mail::message')
# Welcome to Smart Gym!

Hi {{ $name }},

Your account has been successfully registered with the following details:
- Email: {{ $email }}
- Password: {{ $password }}

Please login through this link :


Thank you for joining us!

Regards,
Smart Gym Management
@endcomponent
