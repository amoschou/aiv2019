@extends('festivalinformation.layouts.master')

@section('toolbartitle')
{{ env('APP_NAME') }} {{ $fibsacronymasaname }}
@stop

@section('backbutton')@stop

@section('maincontent')
<h3 class="{{ $titleclass }}">{{ $fibsacronymasaname }}</h3>
<p class="{{ $pclass }}">{{ $fibsacronymasaname }} is {{ strtolower($fibsnameexpanded) }}.</p>

@foreach($navitems as $navitemgroup)
{{--
  @if(!$loop->first)
    <hr class="mdc-list-divider">
  @endif
--}}
  <div id="icon-with-text-demo" class="mdc-list">
    @foreach($navitemgroup as $navitem)
      @if($loop->first)
        <span class="mdc-list-item__text {{$headlineclass}}">
          {{ $navitem }}
        </span>
      @else
        <a href="/{{$fibsacronymlc}}/{{$navitem->itemurl}}" role="listitem" class="mdc-list-item">
          <span class="demo-catalog-list-icon mdc-list-item__graphic"><i class="material-icons mdc-list-item__graphic">{{$navitem->icon}}</i></span>
          <span class="mdc-list-item__text">
            {{ $navitem->name }}
          </span>
        </a>
      @endif
    @endforeach
  </div>
@endforeach



@stop

