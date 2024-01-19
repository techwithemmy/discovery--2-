Hello {{ $demo->receiver_name }},
This is to notify you that your investment plan ({{ $demo->receiver_plan }} plan)  has expired and your capital for this plan has been added to your account for withdrawal.
 
More information:
 
Plan: {{ $demo->receiver_plan }}

Amount: {{ $demo->received_amount }}

Date: {{ $demo->date }}
 
 
Kind regards,

{{ $demo->sender }}.