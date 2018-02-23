@extends('festivalinformation.layouts.master')

@section('toolbartitle')
Dining
@stop

@section('maincontent')
<h4 class="{{ $titleclass }}">24 hour or late dining</h4>

<ul class="{{ $pclass }} mdc-typography--adjust-margin">
  <li class="{{ $pclass }} mdc-typography--adjust-margin">San Giorgio<br>
      Until 2:30&nbsp;AM Su—Th, or 3:30&nbsp; AM Fr—Sa<br>
      217 Rundle Street ADELAIDE</li>
  <li class="{{ $pclass }} mdc-typography--adjust-margin">Barossa Cafe, Adelaide Casino<br>
      24 hour<br>
      North Terrace ADELAIDE</li>
  <li class="{{ $pclass }} mdc-typography--adjust-margin">The Original Pancake Kitchen<br>
      24 hour<br>
      13 Gilbert Place ADELAIDE</li>
  <li class="{{ $pclass }} mdc-typography--adjust-margin">24 Hour Bakery on O’Connell<br>
      24 hour<br>
      128 O’Connell Street NORTH ADELAIDE</li>
  <li class="{{ $pclass }} mdc-typography--adjust-margin">Vili’s Café<br>
      24 hour<br>
      2–14 Manchester Street MILE END</li>
  <li class="{{ $pclass }} mdc-typography--adjust-margin">Enjoy Café Bakery<br>
      24 hour<br>
      112 The Parade NORWOOD</li>
  <li class="{{ $pclass }} mdc-typography--adjust-margin">Cafe Brunelli<br>
      24 hour<br>
      187 Rundle Street ADELAIDE</li>
</ul>

<h4 class="{{ $titleclass }}">Some dining precincts</h4>

<h5 class="{{ $h5class }}">In the city</h5>
<ul class="{{ $ulclass }}">
  <li class="{{ $liclass }}">Rundle Street (Its entire length)</li>
  <li class="{{ $liclass }}">Gouger Street (Chinatown between Morphett St and King William St)</li>
  <li class="{{ $liclass }}">Hutt Street (The south end between Carrington St and Gilles St)</li>
</ul>
<h5 class="{{ $h5class }}">In North Adelaide</h5>
<ul class="{{ $ulclass }}">
  <li class="{{ $liclass }}">O’Connell St (Its entire length)</li>
  <li class="{{ $liclass }}">Tynte St (Near the O’Connell St intersection)</li>
  <li class="{{ $liclass }}">Melbourne St (The northeast end)</li>
</ul>
<h5 class="{{ $h5class }}">South of the city</h5>
<ul class="{{ $ulclass }}">
  <li class="{{ $liclass }}">Goodwood Rd (Between Albert St and Victoria St)</li>
  <li class="{{ $liclass }}">Unley Rd (Most of its length, but dining places are sparser than some other places)</li>
</ul>
<h5 class="{{ $h5class }}">East of the city</h5>
<ul class="{{ $ulclass }}">
  <li class="{{ $liclass }}">The Parade (Between Sydenham Rd and Portrush Rd)</li>
</ul>
<h5 class="{{ $h5class }}">North of the city</h5>
<ul class="{{ $ulclass }}">
  <li class="{{ $liclass }}">Prospect Rd (Between Milner St and Olive St)</li>
</ul>
<h5 class="{{ $h5class }}">West of the city</h5>
<ul class="{{ $ulclass }}">
  <li class="{{ $liclass }}">Henley Beach Rd (Between Marion Rd and James Congdon Dr, some good places but they are very sparse along here)</li>
</ul>

@stop