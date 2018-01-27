@switch($exinternal)
  @case('external')
    Thank you for sending
    @break
  @case('internal')
    Somebody sent
    @break
@endswitch
the following message at {{ $data->time }} ({{ $data->timezone }}) on {{ $data->date }}:
 
From: {{ $data->name }} ({{ $data->email }})
To: AIVCF Adelaide

Subject: {{ $data->subject }}

{{ $data->message }}
