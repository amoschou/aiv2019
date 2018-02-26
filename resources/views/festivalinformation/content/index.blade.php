@extends('festivalinformation.layouts.master')

@section('toolbartitle')
{{ env('APP_NAME') }} {{ $fibsacronymasaname }}
@stop

@section('backbutton')@stop

@section('maincontent')
<h3 class="{{ $titleclass }}">{{ $fibsacronymasaname }}</h3>
<p class="{{ $headlineclass }}">{{ $fibsacronymasaname }} is {{ strtolower($fibsnameexpanded) }}.</p>
<p class="{{ $pclass }}">Click the menu icon above to get started.</p>

<div class="mdc-grid-list">
  <ul class="mdc-grid-list__tiles">
    <li class="mdc-grid-tile">
      <div class="mdc-grid-tile__primary">
        <i class="material-icons mdc-list-item__graphic md-48" aria-hidden="true">event</i>
      </div>
    </li>
    <li class="mdc-grid-tile">
      <div class="mdc-grid-tile__primary">
        <img class="mdc-grid-tile__primary-content" src="images/1-1.jpg" />
      </div>
    </li>
    <li class="mdc-grid-tile">
      <div class="mdc-grid-tile__primary">
        <img class="mdc-grid-tile__primary-content" src="images/1-1.jpg" />
      </div>
    </li>
    <li class="mdc-grid-tile">
      <div class="mdc-grid-tile__primary">
        <img class="mdc-grid-tile__primary-content" src="images/1-1.jpg" />
      </div>
    </li>
    <li class="mdc-grid-tile">
      <div class="mdc-grid-tile__primary">
        <img class="mdc-grid-tile__primary-content" src="images/1-1.jpg" />
      </div>
    </li>
    <li class="mdc-grid-tile">
      <div class="mdc-grid-tile__primary">
        <img class="mdc-grid-tile__primary-content" src="images/1-1.jpg" />
      </div>
    </li>
  </ul>
</div>

@stop

