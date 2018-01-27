<p>
@switch($exinternal)
  @case('external')
    Thank you for sending
    @break
  @case('internal')
    Somebody sent
    @break
@endswitch
the following message at {{ $data->time }} ({{ $data->timezone }}) on {{ $data->date }}:</p>

<p>From: {{ $data->name }} ({{ $data->email }})<br>
To: AIVCF Adelaide</p>

<p>Subject: {{ $data->subject }}</p>

<pre>{{ $data->message }}</pre>
