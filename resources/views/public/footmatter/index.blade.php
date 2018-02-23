<?php
  $activetab = NULL;
?>

@extends('public.layouts.base')

@section('cardtitle')
@stop

@section('featureblock')
@stop

@section('cellsupportingtext')
  <h3>{{ $titletext }}</h3>
  @switch($titletext)
    @case('Code of conduct')
      <p>This code of conduct has been in place at festivals for several years now and registrants should be familiar with it.</p>
      @include('public.footmatter.conduct')
      @break
    @case('Summary of the privacy policy')
      @include('public.footmatter.privacysummary')
      @break
    @case('Privacy policy')
      @include('public.footmatter.privacymain')
      @break
    @case('Affiliates')
      @include('public.footmatter.privacyaffiliates')
      @break
    @case('Help')
      @include('public.footmatter.help')
      @break
  @endswitch
@stop 