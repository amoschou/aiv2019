@php

  function generate_navitem_drawer($navitem)
  {
    $fibsacronymlc = strtolower(env('FIBS_ACRONYM'));
    $itemclass = 'a';
    $str = '';
    $str .= "";
    $str .= "";
    $str .= '</a>';
    return $str;
  }

@endphp


@foreach($navitems as $navitemgroup)
{{--
  @if(!$loop->first)
    <hr class="mdc-list-divider">
  @endif
--}}
  <div id="icon-with-text-demo" class="mdc-list">
    @foreach($navitemgroup as $navitem)
      @if($loop->first)
        <span class="mdc-list-item demo-drawer-list-item">
          {{$navitem}}
        </span>
      @else
        <a class="mdc-list-item demo-drawer-list-item{{ request()->getPathInfo() === "/{$fibsacronymlc}/{$navitem->itemurl}" ? ' mdc-list-item--selected' : '' }}" href="/{{$fibsacronymlc}}/{{$navitem->itemurl}}">
          <i class="material-icons mdc-list-item__graphic" aria-hidden="true">{{$navitem->icon}}</i>{{$navitem->name}}
        </a>
      @endif
    @endforeach
  </div>
@endforeach

{{--
in iCal format (public)
https://calendar.google.com/calendar/ical/sd4s73bgtj4j2os3ojonlhnj6c%40group.calendar.google.com/public/basic.ics

in iCal format (private)
https://calendar.google.com/calendar/ical/sd4s73bgtj4j2os3ojonlhnj6c%40group.calendar.google.com/private-b8671201ea4bf52f1939e8919cbb3f55/basic.ics
--}}
