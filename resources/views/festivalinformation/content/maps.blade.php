@extends('festivalinformation.layouts.master')

@section('toolbartitle')
Maps
@stop

@section('extrastyle')
<style>
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
  <a role="tab" aria-controls="panel-1" class="mdc-tab mdc-tab--active" href="#panel-1">Adelaide Uni</a>
  <a role="tab" aria-controls="panel-2" class="mdc-tab" href="#panel-2">City of Adelaide</a>
  <span class="mdc-tab-bar__indicator"></span>
</nav>
@stop

@section('maincontent')
  <div class="panels">
    <div class="panel active" id="panel-1" role="tabpanel" aria-hidden="false">
      <h3 class="{{ $titleclass }}">The University of Adelaide, North Terrace campus</h3>
      <ul class="mdc-list mdc-list--two-line mdc-list--avatar-list demo-list demo-list--with-avatars demo-list--icon-placeholders">
        <a class="mdc-list-item" href="https://www.adelaide.edu.au/campuses/northtce/">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">tablet</i>
          <span class="mdc-list-item__text">
            Online interactive
            <span class="mdc-list-item__secondary-text">www.adelaide.edu.au/campuses/northtce/</span>
          </span>
        </a>
        <a class="mdc-list-item" href="https://www.adelaide.edu.au/campuses/mapscurrent/north_terrace.pdf">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">picture_as_pdf</i>
          <span class="mdc-list-item__text">
            Printable A4 version, PDF
            <span class="mdc-list-item__secondary-text">www.adelaide.edu.au/campuses/mapscurrent/north_terrace.pdf</span>
          </span>
        </a>
        <a class="mdc-list-item" href="https://www.adelaide.edu.au/campuses/mapscurrent/north-terrace-a3.pdf">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">picture_as_pdf</i>
          <span class="mdc-list-item__text">
           Printable A3 version, PDF
            <span class="mdc-list-item__secondary-text">www.adelaide.edu.au/campuses/mapscurrent/north-terrace-a3.pdf</span>
          </span>
        </a>
        <a class="mdc-list-item" href="https://www.adelaide.edu.au/campuses/mapscurrent/north_terrace.jpg">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">image</i>
          <span class="mdc-list-item__text">
            Printable, JPEG
            <span class="mdc-list-item__secondary-text">www.adelaide.edu.au/campuses/mapscurrent/north_terrace.jpg</span>
          </span>
        </a>
      </ul>
    </div>
    <div class="panel" id="panel-2" role="tabpanel" aria-hidden="true">
      <h3 class="{{ $titleclass }}">City of Adelaide</h3>
      <ul class="mdc-list mdc-list--two-line mdc-list--avatar-list demo-list demo-list--with-avatars demo-list--icon-placeholders">
        <a class="mdc-list-item" href="https://www.cityofadelaide.com.au/assets/documents/Explore_the_COA_Map_Sept17.pdf">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">picture_as_pdf</i>
          <span class="mdc-list-item__text">
            Explore version, PDF
            <span class="mdc-list-item__secondary-text">www.cityofadelaide.com.au/assets/documents/Explore_the_COA_Map_Sept17.pdf</span>
          </span>
        </a>
        <a class="mdc-list-item" href="https://www.cityofadelaide.com.au/assets/coa/Info/city-of-adelaide-map.pdf">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">picture_as_pdf</i>
          <span class="mdc-list-item__text">
            Printable version, PDF
            <span class="mdc-list-item__secondary-text">www.cityofadelaide.com.au/assets/coa/Info/city-of-adelaide-map.pdf</span>
          </span>
        </a>
        <a class="mdc-list-item" href="https://adelaideconciergemap.partica.online/adelaide-concierge-map/adelaide-concierge-map/flipbook/1/">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">tablet</i>
          <span class="mdc-list-item__text">
            Concierge map, Online book
            <span class="mdc-list-item__secondary-text">adelaideconciergemap.partica.online/adelaide-concierge-map/adelaide-concierge-map/flipbook/1/</span>
          </span>
        </a>
        <a class="mdc-list-item" href="http://www.adelaideparklands.com.au/explore-map/">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">tablet</i>
          <span class="mdc-list-item__text">
            Park lands, Online interactive
            <span class="mdc-list-item__secondary-text">www.adelaideparklands.com.au/explore-map/</span>
          </span>
        </a>
      </ul>
    </div>
  </div>
@stop