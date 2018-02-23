@extends('registration.dashboard')


@php
  $users = DB::table("view_rego_responses_$sectionshortname")->get();
var_dump($users); die();
@endphp

  
@section('innercontent')
  @foreach($users as $user)
    
  @endforeach
@endsection

