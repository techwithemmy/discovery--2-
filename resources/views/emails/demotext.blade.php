Hello {{ $demo->receiver_name }},
Your registeration was successful! Below are your login credentials. Please keep safe.
 
Login details:
 
Email: {{ $demo->receiver_email }}

Password: {{ $demo->receiver_password }}
 
 
Kind regards,

{{ $demo->sender }}.