@extends('festivalinformation.layouts.master')

@section('toolbartitle')
Fine print
@stop

@section('extrastyle')
<style>
  .my-modified-toolbar-section {
    position: absolute;
    right: 0;
    bottom: -16px;
  }
  .panel {
    display: none;
  }
  .panel.active {
    display: block;
  }
</style>
@stop

@section('scriptfortabs')
<script>
  demoReady(function() {
    var dynamicTabBar = window.dynamicTabBar = new mdc.tabs.MDCTabBar(document.querySelector('#tab-bar'));
    var panels = document.querySelector('.panels');
    dynamicTabBar.tabs.forEach(function(tab) {
      tab.preventDefaultOnClick = true;
    });
    function updatePanel(index) {
      var activePanel = panels.querySelector('.panel.active');
      if (activePanel) {
        activePanel.classList.remove('active');
      }
      var newActivePanel = panels.querySelector('.panel:nth-child(' + (index + 1) + ')');
      if (newActivePanel) {
        newActivePanel.classList.add('active');
      }
    }
    dynamicTabBar.listen('MDCTabBar:change', function ({detail: tabs}) {
      var nthChildIndex = tabs.activeTabIndex;
      updatePanel(nthChildIndex);
    });

  });
</script>
@stop

@section('basictabbar')
<nav id="tab-bar" class="mdc-tab-bar" role="tablist">
  <a role="tab" aria-controls="panel-1" class="mdc-tab mdc-tab--active" href="#panel-1">Conduct</a>
  <a role="tab" aria-controls="panel-2" class="mdc-tab" href="#panel-2">Privacy</a>
  <span class="mdc-tab-bar__indicator"></span>
</nav>
@stop

@section('maincontent')
  <div class="panels">
    <div class="panel active" id="panel-1" role="tabpanel" aria-hidden="false">
      <h3 class="{{ $titleclass }}">Code of conduct</h3>
      @include('public.footmatter.conduct')
    </div>
    <div class="panel" id="panel-2" role="tabpanel" aria-hidden="true">
      <h3 class="{{ $titleclass }}">Privacy policy</h3>
      @include('public.footmatter.privacymain')
    </div>
  </div>
@stop