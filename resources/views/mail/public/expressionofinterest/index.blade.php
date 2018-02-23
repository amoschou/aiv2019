<p>
@switch($exinternal)
  @case('external')
    Thank you for expressing
    @break
  @case('internal')
    Somebody expressed
    @break
@endswitch
interest in being a chorister in the festival at {{ $data->time }} ({{ $data->timezone }}) on {{ $data->date }}:</p>

<p>Name: {{ $data->name }}<br>
Email address: {{ $data->email }}<br>
Phone number: {{ $data->phone }}<br>
Message or internet banking receipt:<br>
<pre>{{ $data->receipt }}</pre></p>
