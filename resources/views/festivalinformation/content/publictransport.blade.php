@extends('festivalinformation.layouts.master')

@section('toolbartitle')
Public transport
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
  <a role="tab" aria-controls="panel-1" class="mdc-tab mdc-tab--active" href="#panel-1">Essential routes</a>
  <a role="tab" aria-controls="panel-2" class="mdc-tab" href="#panel-2">Tickets and fares</a>
  <a role="tab" aria-controls="panel-3" class="mdc-tab" href="#panel-3">Planning journeys</a>
  <span class="mdc-tab-bar__indicator"></span>
</nav>
@stop

@section('maincontent')
  <ul class="{{ $ulclass }}">
    <li class="{{ $liclass }}">Adelaide Metro: <a href="https://www.adelaidemetro.com.au">https://www.adelaidemetro.com.au</a></li>
    <li class="{{ $liclass }}">MetroMATE app: <a href="https://www.adelaidemetro.com.au/metroMATE/Home">https://www.adelaidemetro.com.au/metroMATE/Home</a></li>
  </ul>
  <div class="panels">
    <div class="panel active" id="panel-1" role="tabpanel" aria-hidden="false">
      <h3 class="{{ $titleclass }}">Essential routes</h3>
      <h4 class="{{ $h4class }}">Belair train</h4>
      <ul class="mdc-list mdc-list--two-line mdc-list--avatar-list demo-list demo-list--with-avatars demo-list--icon-placeholders">
        <a class="mdc-list-item" href="https://www.adelaidemetro.com.au/routes/BEL">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">smartphone</i>
          <span class="mdc-list-item__text">
            Online
            <span class="mdc-list-item__secondary-text">https://www.adelaidemetro.com.au/routes/BEL</span>
          </span>
        </a>
        <a class="mdc-list-item" href="https://www.adelaidemetro.com.au/content/download/378/55581/file/Belair_train_121014_ttable_routemap.pdf">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">picture_as_pdf</i>
          <span class="mdc-list-item__text">
            Printable version, PDF
            <span class="mdc-list-item__secondary-text">https://www.adelaidemetro.com.au/content/download/378/55581/file/Belair_train_121014_ttable_routemap.pdf</span>
          </span>
        </a>
      </ul>
      <h4 class="{{ $h4class }}">Airport services</h4>
      <ul class="mdc-list mdc-list--two-line mdc-list--avatar-list demo-list demo-list--with-avatars demo-list--icon-placeholders">
        <a class="mdc-list-item" href="https://www.adelaidemetro.com.au/Timetables-Maps/Special-Services/Airport-services">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">smartphone</i>
          <span class="mdc-list-item__text">
            Online
            <span class="mdc-list-item__secondary-text">https://www.adelaidemetro.com.au/Timetables-Maps/Special-Services/Airport-services</span>
          </span>
        </a>
      </ul>
    </div>
    <div class="panel" id="panel-1" role="tabpanel" aria-hidden="true">
      <h3 class="{{ $titleclass }}">Tickets and fares</h3>
      <p class="{{ $pclass }}">If you are from interstate, you will probably need to pay full priced regular fares on Adelaide Metro services even if you are a student, so only regular fares are discussed here.</p>
      <p class="{{ $pclass }}">You have the choice of using a metrocard or metrotickets. Buying and using a regular Metrocard is cheaper than using singletrip metrotickets if you pay at least two fares. Daytrip metrotickets or a visitor pass metrocard might also be cheaper options in some circumstances.</p>
      <p class="{{ $pclass }}">Validate (that is ‘touch on’) your ticket or metrocard whenever you board a bus, train or tram. Once you’ve first validated, you’re free to travel for two hours as many times as you like without paying another fare. This two hour window of unlimited validations until you finally get off is called a ‘trip’. In Adelaide, we don’t ‘touch off’.</p>
      <p class="{{ $pclass }}">Travel in interpeak times is cheaper than in peak times.</p>
      <ul class="{{ $ulclass }}">
        <li class="{{ $liclass }}">Interpeak: First validation between 9:01 and 3:00 on weekdays or at any time on Sundays or public holidays.</li>
        <li class="{{ $liclass }}">Peak: First validation at any other time.</li>
      </ul>
      <p class="{{ $pclass }}">Visit <a href="https://www.adelaidemetro.com.au/Tickets/Fares">https://www.adelaidemetro.com.au/Tickets/Fares</a> for up to date fare information.</p>
      <h4 class="{{ $h4class }}">Metrocard</h4>
      <p class="{{ $pclass }}">Metrocards come in various varieties. Don’t bother with the 2 section card, the two that you’d be interested in are:</p>
      <ul class="{{ $ulclass }}">
        <li class="{{ $liclass }}">Regular metrocard</li>
        <li class="{{ $liclass }}">Three day visitor pass</li>
      </ul>
      <p class="{{ $pclass }}">A regular card costs $10 initially ($5 for the card itself and $5 starting balance).</p>
      <p class="{{ $pclass }}">A visitor pass costs $26.60 for three days of unlimited public transport. After the three days, you can top it up and it will behave like an ordinary regular metrocard.</p> 
      <p class="{{ $pclass }}">A visitor pass is cheaper than a regular card if you make six or more peak trips or eleven or more interpeak trips (or some combination) in the first three days.</p>
      <p class="{{ $pclass }}">Metrocards can be purchased from WH Smith Express at Adelaide Airport. You can recharge on board trains and trams (vending machines use coins only) and at other places.</p>
      <h4 class="{{ $h4class }}">Metrotickets</h4>
      <p class="{{ $pclass }}">The varieties of interest are:</p>
      <ul class="{{ $ulclass }}">
        <li class="{{ $liclass }}">Singletrip (Your trip lasts for two hours)</li>
        <li class="{{ $liclass }}">Daytrip (Your trip lasts until 4:30 AM)</li>
      </ul>
      <p class="{{ $pclass }}">Metrotickets can be purchased on board buses (have exact change only or as close as possible) and on board trains and trams (vending machines use coins only).</p>
    </div>
    <div class="panel" id="panel-1" role="tabpanel" aria-hidden="true">
      <h3 class="{{ $titleclass }}">Planning journeys</h3>
      <p class="{{ $pclass }}">Timetables are integrated into two interactive maps:</p>
      <ul class="{{ $ulclass }}">
        <li class="{{ $liclass }}"><a href="https://www.adelaidemetro.com.au/planner/">https://www.adelaidemetro.com.au/planner/</a></li>
        <li class="{{ $liclass }}"><a href="https://www.google.com.au/maps">https://www.google.com.au/maps</a></li>
      </ul>
      <p class="{{ $pclass }}">Both methods generally give you the same results but be careful and check how they factor in walking time from your current location to the stop or station.</p>
    </div>
  </div>
@stop