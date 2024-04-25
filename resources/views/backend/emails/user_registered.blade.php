@component('mail::message')
# Welcome to Smart Gym!

Hi {{ $name }},

Your account has been successfully registered with the following details:
- Email: {{ $email }}
- Password: {{ $password }}

Please login through this link :
http://127.0.0.1:8000/user


Thank you for joining us!

Regards,
Smart Gym Management
@endcomponent
