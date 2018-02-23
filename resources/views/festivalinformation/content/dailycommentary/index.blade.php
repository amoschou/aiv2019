@extends('festivalinformation.layouts.master')

@section('toolbartitle')
Daily commentary
@stop

@section('styleforselect')
<style>
  /* Hack to work around style-loader asynchronously loading styles. */
  /* Equivalent to using mdc-typography's subheading2, which is used in the sass file. */
  .mdc-select {
    font-family: Roboto, sans-serif;
    font-size: 1rem;
    font-weight: 400;
    letter-spacing: .04em;
  }
  .dailycommentary-panel {
    display: none;
  }
  .dailycommentary-panel.active {
    display: block;
  }
</style>
@stop

@section('scriptforselect')
<script>
demoReady(function() {
  var root = document.getElementById('js-select');
  var boxCurrentlySelected = document.getElementById('currently-selected');
  var select = new mdc.select.MDCSelect(root);

  root.addEventListener('MDCSelect:change', function() {
    updatePanel('panel-' + select.value);
  });

  function updatePanel(id) {
    var panelList = document.getElementsByClassName('dailycommentary-panel');
    for(var i = 0 ; i < panelList.length; i++)
    {
      panelList[i].classList.remove('active');
    }
    document.getElementById(id).classList.add('active');
  }
});
</script>
@stop

@section('maincontent')
<h3 class="{{ $titleclass }}">Daily commentary</h3>

<div id="js-select" class="mdc-select" role="listbox">
  <div class="mdc-select__surface" tabindex="0">
    <div class="mdc-select__label">Select day</div>
    <div class="mdc-select__selected-text"></div>
    <div class="mdc-select__bottom-line"></div>
  </div>
  <div class="mdc-menu mdc-select__menu">
    <ul class="mdc-list mdc-menu__items">
      <li class="mdc-list-item" role="option" id="20190110" tabindex="0" aria-controls="panel-20190110" >
        Day 1: Thursday, 10 January
      </li>
      <li class="mdc-list-item" role="option" id="20190111" tabindex="0" aria-controls="panel-20190111" >
        Day 2: Friday, 11 January
      </li>
      <li class="mdc-list-item" role="option" id="20190112" tabindex="0" aria-controls="panel-20190112" >
        Day 3: Saturday, 12 January
      </li>
    </ul>
  </div>
</div>

<div class="panels">
  <div class="dailycommentary-panel active" id="panel-20190110" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190110')
  </div>
  <div class="dailycommentary-panel" id="panel-20190111" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190111')
  </div>
  <div class="dailycommentary-panel" id="panel-20190112" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190112')
  </div>
  {{--
  <div class="dailycommentary-panel" id="panel-20190113" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190113')
  </div>
  <div class="dailycommentary-panel" id="panel-20190114" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190114')
  </div>
  <div class="dailycommentary-panel" id="panel-20190115" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190115')
  </div>
  <div class="dailycommentary-panel" id="panel-20190116" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190116')
  </div>
  <div class="dailycommentary-panel" id="panel-20190117" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190117')
  </div>
  <div class="dailycommentary-panel" id="panel-20190118" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190118')
  </div>
  <div class="dailycommentary-panel" id="panel-20190119" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190119')
  </div>
  <div class="dailycommentary-panel" id="panel-20190120" aria-hidden="false">
    @include('festivalinformation.content.dailycommentary.20190120')
  </div>
  --}}
</div>
@stop
