@extends('festivalinformation.layouts.master')

@section('toolbartitle')
Calendar and events
@stop

@section('maincontent')
<h3 class="{{ $titleclass }}">Calendar and events</h3>
<p>Eventually, the Google calendar will go here, also downloadable in iCal format.</p>
<iframe
{{--
    src="#"
--}}
    style="border-width:0"
    width="800"
    height="600"
    frameborder="0"
    scrolling="no">
</iframe>
@stop