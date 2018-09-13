@extends('registration.layouts.appwithnotopbox')

@section('innercontent')
  <h1>Personal information</h1>
  <dl class="row">
    @foreach($people as $person)
      <dt class="col-sm-1">{{ $person->id }}</dt>
      <dd class="col-sm-11"><a href="/home/personalinformation/person/{{ $person->id }}">{{ $person->firstname }} {{ $person->lastname }}</a></dd>
    @endforeach
  </dl>
@endsection
