@switch($exinternal)
  @case('external')
    Thank you for expressing
    @break
  @case('internal')
    Somebody expressed
    @break
@endswitch
interest in being a chorister in the festival at {{ $data->time }} ({{ $data->timezone }}) on {{ $data->date }}:
 
Name: {{ $data->name }}
Email address: {{ $data->email }}
Phone number: {{ $data->phone }}
Message or internet banking receipt:
{{ $data->receipt }}
