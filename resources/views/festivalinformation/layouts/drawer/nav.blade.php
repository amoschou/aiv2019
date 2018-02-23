<div id="icon-with-text-demo" class="mdc-list">
  @php
    $itemurl = 'calendar';
    $itemclass = request()->getPathInfo() === "/{$fibsacronymlc}/{$itemurl}" ? ' mdc-list-item--selected' : '';
  @endphp
  <a class="mdc-list-item demo-drawer-list-item{{ $itemclass }}" href="/{{ $fibsacronymlc }}/{{ $itemurl }}">
    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">event</i>Calendar and events
  </a>
  @php
    $itemurl = 'dailycommentary';
    $itemclass = request()->getPathInfo() === "/{$fibsacronymlc}/{$itemurl}" ? ' mdc-list-item--selected' : '';
  @endphp
  <a class="mdc-list-item demo-drawer-list-item{{ $itemclass }}" href="/{{ $fibsacronymlc }}/{{ $itemurl }}">
    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">event_note</i>Daily commentary
  </a>
</div>
<hr class="mdc-list-divider">
<div class="mdc-list">
  @php
    $itemurl = 'maps';
    $itemclass = request()->getPathInfo() === "/{$fibsacronymlc}/{$itemurl}" ? ' mdc-list-item--selected' : '';
  @endphp
  <a class="mdc-list-item demo-drawer-list-item{{ $itemclass }}" href="/{{ $fibsacronymlc }}/{{ $itemurl }}">
    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">map</i>Maps
  </a>
  @php
    $itemurl = 'publictransport';
    $itemclass = request()->getPathInfo() === "/{$fibsacronymlc}/{$itemurl}" ? ' mdc-list-item--selected' : '';
  @endphp
  <a class="mdc-list-item demo-drawer-list-item{{ $itemclass }}" href="/{{ $fibsacronymlc }}/{{ $itemurl }}">
    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">directions_bus</i>Public transport
  </a>
  @php
    $itemurl = 'dining';
    $itemclass = request()->getPathInfo() === "/{$fibsacronymlc}/{$itemurl}" ? ' mdc-list-item--selected' : '';
  @endphp
  <a class="mdc-list-item demo-drawer-list-item{{ $itemclass }}" href="/{{ $fibsacronymlc }}/{{ $itemurl }}">
    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">local_dining</i>Dining
  </a>
</div>
<hr class="mdc-list-divider">
<div class="mdc-list">
  @php
    $itemurl = 'fineprint';
    $itemclass = request()->getPathInfo() === "/{$fibsacronymlc}/{$itemurl}" ? ' mdc-list-item--selected' : '';
  @endphp
  <a class="mdc-list-item demo-drawer-list-item{{ $itemclass }}" href="/{{ $fibsacronymlc }}/{{ $itemurl }}">
    <i class="material-icons mdc-list-item__graphic" aria-hidden="true">description</i>Fine print
  </a>
</div>

{{--
in iCal format (public)
https://calendar.google.com/calendar/ical/sd4s73bgtj4j2os3ojonlhnj6c%40group.calendar.google.com/public/basic.ics

in iCal format (private)
https://calendar.google.com/calendar/ical/sd4s73bgtj4j2os3ojonlhnj6c%40group.calendar.google.com/private-b8671201ea4bf52f1939e8919cbb3f55/basic.ics
--}}
