@extends('public.layouts.base')


@section('cellsupportingtext')
  @if(isset($essay))
    @foreach ($essay as $section)
      @if($section[0] !== '')
        <h3 {{-- class="mdl-typography--headline" --}}>{{ $section[0] }}</h3>
      @endif
      @foreach ($section[1] as $par)
        <p>{!! $par !!}</p>
      @endforeach
    @endforeach
  @endif
  @if(isset($text1))
    @foreach ($text1 as $par)
      <p>{{ $par }}</p>
    @endforeach
  @endif
  @section('receiptmessage')
  @stop
@stop



