@extends ('public.layouts.base')

@section('class') portfolio-contact @endsection



@section('cellsupportingtext')

<p>Thank you for sending the following message at {{ $data->time }} ({{ $data->timezone }}) on {{ $data->date }}:</p>

<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
  <div class="mdl-card__supporting-text">
    From: {{ $data->name }} ({{ $data->email }})<br>To: AIVCF Adelaide
  </div>
  <div class="mdl-card__title mdl-card--border" style="border-top: 1px solid rgba(0, 0, 0, .1)">
    <h4 class="mdl-card__title-text">{{ $data->subject }}</h4>
  </div>
  <div class="mdl-card__supporting-text mdl-card--border">{!! nl2br(e($data->message)) !!}</div>
</div>

@endsection


