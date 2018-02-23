@extends('festivalinformation.layouts.master')

@section('toolbartitle')
{{ env('APP_NAME') }} {{ $fibsacronymasaname }}
@stop

@section('backbutton')@stop

@section('maincontent')
<h3 class="{{ $titleclass }}">{{ $fibsacronymasaname }}</h3>
<p class="{{ $headlineclass }}">{{ $fibsacronymasaname }} is {{ strtolower($fibsnameexpanded) }}.</p>
<p class="{{ $pclass }}">Click the menu icon above to get started.</p>
@stop

