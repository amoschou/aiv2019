<?php
  $activetab = 'participate';
?>

@extends('layouts.base')

@section('cardtitle')
@stop


@section('featureblock')
@stop


@section('cellsupportingtext')

  <h3>{{ $titletext }}</h3>

  @if($titletext == 'Information for registrants')
  
  <p><a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="/participate/informationforregistrants/publictransport">Public transport: Adelaide Metro</a></p>
  <p><a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="/participate/informationforregistrants/dining">Dining in Adelaide</a></p>
  
  @elseif($titletext == 'Dining in Adelaide')

  <h4>24 hour or late dining</h4>
  
  <ul class="mdl-list">
    <li class="mdl-list__item mdl-list__item--three-line">
      <span class="mdl-list__item-primary-content">
        <i class="material-icons mdl-list__item-avatar">local_dining</i>
        <span>San Giorgio</span>
        <span class="mdl-list__item-text-body">
          Until 2:30&nbsp;AM Su—Th, or 3:30&nbsp; AM Fr—Sa<br>
          217 Rundle Street ADELAIDE
        </span>
      </span>
      <!--
      <span class="mdl-list__item-secondary-content">
        <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
      </span>
      -->
    </li>
    <li class="mdl-list__item mdl-list__item--three-line">
      <span class="mdl-list__item-primary-content">
        <i class="material-icons mdl-list__item-avatar">local_dining</i>
        <span>Barossa Cafe, Adelaide Casino</span>
        <span class="mdl-list__item-text-body">
          24 hour<br>
          North Terrace ADELAIDE
        </span>
      </span>
    </li>
    <li class="mdl-list__item mdl-list__item--three-line">
      <span class="mdl-list__item-primary-content">
        <i class="material-icons mdl-list__item-avatar">local_dining</i>
        <span>The Original Pancake Kitchen</span>
        <span class="mdl-list__item-text-body">
          24 hour<br>
          13 Gilbert Place ADELAIDE
        </span>
      </span>
    </li>
    <li class="mdl-list__item mdl-list__item--three-line">
      <span class="mdl-list__item-primary-content">
        <i class="material-icons mdl-list__item-avatar">local_dining</i>
        <span>24 Hour Bakery on O’Connell</span>
        <span class="mdl-list__item-text-body">
          24 hour<br>
          128 O’Connell Street NORTH ADELAIDE
        </span>
      </span>
    </li>
    <li class="mdl-list__item mdl-list__item--three-line">
      <span class="mdl-list__item-primary-content">
        <i class="material-icons mdl-list__item-avatar">local_dining</i>
        <span>Vili’s Café</span>
        <span class="mdl-list__item-text-body">
          24 hour<br>
          2–14 Manchester Street MILE END
        </span>
      </span>
    </li>
    <li class="mdl-list__item mdl-list__item--three-line">
      <span class="mdl-list__item-primary-content">
        <i class="material-icons mdl-list__item-avatar">local_dining</i>
        <span>Enjoy Café Bakery</span>
        <span class="mdl-list__item-text-body">
          24 hour<br>
          112 The Parade NORWOOD
        </span>
      </span>
    </li>
    <li class="mdl-list__item mdl-list__item--three-line">
      <span class="mdl-list__item-primary-content">
        <i class="material-icons mdl-list__item-avatar">local_dining</i>
        <span>Cafe Brunelli</span>
        <span class="mdl-list__item-text-body">
          24 hour<br>
          187 Rundle Street ADELAIDE
        </span>
      </span>
    </li>
  </ul>

  <h4>Some dining precincts</h4>
  
  <p>In the city</p>
  <ul>
    <li>Rundle Street (Its entire length)</li>
    <li>Gouger Street (Chinatown between Morphett St and King William St)</li>
    <li>Hutt Street (The south end between Carrington St and Gilles St)</li>
  </ul>
  <p>In North Adelaide</p>
  <ul>
    <li>O’Connell St (Its entire length)</li>
    <li>Tynte St (Near the O’Connell St intersection)</li>
    <li>Melbourne St (The northeast end)</li>
  </ul>
  <p>South of the city</p>
  <ul>
    <li>Goodwood Rd (Between Albert St and Victoria St)</li>
    <li>Unley Rd (Most of its length, but dining places are sparser than some other places)</li>
  </ul>
  <p>East of the city</p>
  <ul>
    <li>The Parade (Between Sydenham Rd and Portrush Rd)</li>
  </ul>
  <p>North of the city</p>
  <ul>
    <li>Prospect Rd (Between Milner St and Olive St)</li>
  </ul>
  <p>West of the city</p>
  <ul>
    <li>Henley Beach Rd (Between Marion Rd and James Congdon Dr, some good places but they are very sparse along here)</li>
  </ul>

  @elseif($titletext == 'Public transport: Adelaide Metro')

  <p>See <a href="https://www.adelaidemetro.com.au">https://www.adelaidemetro.com.au</a> for official and up to date information.</p>
  
  <h4>Tickets and fares</h4>
  
  <p>If you are from interstate, you will probably need to pay full priced regular fares on Adelaide Metro services even if you are a student, so only regular fares are discussed here.</p>
  <p>You have the choice of using a metrocard or metrotickets. Buying and using a regular Metrocard is cheaper than using singletrip metrotickets if you pay at least two fares. Daytrip metrotickets or a visitor pass metrocard might also be cheaper options in some circumstances.</p>
  <p>Validate (that is ‘touch on’) your ticket or metrocard whenever you board a bus, train or tram. Once you’ve first validated, you’re free to travel for two hours as many times as you like without paying another fare. This two hour window of unlimited validations is called a ‘trip’. In Adelaide, we don’t ‘touch off’.</p>
  <p>Travel in interpeak times is cheaper than in peak times.</p>
  <ul>
    <li>Interpeak: First validation between 9:01 and 3:00 on weekdays or at any time on Sundays or public holidays.</li>
    <li>Peak: First validation at any other time.</li>
  </ul>
  <p>Visit <a href="https://www.adelaidemetro.com.au/Tickets/Fares">https://www.adelaidemetro.com.au/Tickets/Fares</a> for up to date fare information.</p>
  
  <h5>Metrocard</h5>
  
  <p>Metrocards come in various varieties. Don’t bother with the 2 section card, the two that you’d be interested in are:</p>
  <ul>
    <li>Regular metrocard</li>
    <li>Three day visitor pass</li>
  </ul>
  <p>A regular card costs $10 initially ($5 for the card itself and $5 starting balance).</p>
  <p>A visitor pass costs $26.60 for three days of unlimited public transport. After the three days, you can top it up and it will behave like an ordinary regular metrocard.</p> 
  <p>A visitor pass is cheaper than a regular card if you make six or more peak trips or eleven or more interpeak trips (or some combination) in the first three days.</p>
  <p>Metrocards can be purchased from WH Smith Express at Adelaide Airport. You can recharge on board trains and trams (vending machines use coins only) and at other places.</p>
  
  <h5>Metrotickets</h5>
  
  <p>The varieties of interest are:</p>
  <ul>
    <li>Singletrip (Your trip lasts for two hours)</li>
    <li>Daytrip (Your trip lasts until 4:30 AM)</li>
  </ul>
  <p>Metrotickets can be purchased on board buses (have exact change only or as close as possible) and on board trains and trams (vending machines use coins only).</p>
  
  <h4>Planning journeys</h4>
  
  <p>Timetables are integrated into two interactive maps:</p>
  <ul>
    <li>https://www.adelaidemetro.com.au/planner/</li>
    <li>https://www.google.com.au/maps</li>
  </ul>
  <p>Both methods generally give you the same results but be careful and check how they factor in walking time from your current location to the stop or station.</p>

  @elseif ($titletext == '')

  @elseif ($titletext == '')
  
  @endif

@stop

