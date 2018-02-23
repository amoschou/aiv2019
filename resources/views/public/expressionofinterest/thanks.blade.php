@extends ('public.layouts.base')

@section('class') portfolio-contact @endsection



@section('cellsupportingtext')

<p>Thank you for expressing your interest to be a chorister in the festival:</p>

<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
  <div class="mdl-card__supporting-text">
    Name: {{ $data->name }}<br>Email address: {{ $data->email }}<br>Phone number: {{ $data->phone }}<br>Message or internet banking receipt:<br><pre>{{ $data->receipt }}</pre>
  </div>
</div>

@endsection


