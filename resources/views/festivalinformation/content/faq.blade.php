@extends('festivalinformation.layouts.master')

@section('toolbartitle')
Frequently asked questions
@stop

@php
  $qandas = [];
  $qandas[] = [
    'I am visiting Adelaide. What are my accommodation options?',
    "<p class=\"{$pclass}\">The festival goes from 10 to 20 January 2019. If you are a chorister, you will need to be at camp from the 11th to the 15th because essential rehearsals are there. Accommodation is available at camp for four nights from the 11th for everybody, however you can choose to stay elsewhere during this time.</p>
     <p class=\"{$pclass}\">Outside of camp time, i.e. on the 10th, and from the 15th until the end of the festival, we seek billeting options for students. Students are free to choose to find their own accommodation if they so wish, which makes things significantly easier for us doing the organisation.</p>
     <p class=\"{$pclass}\">Those who are not students will need to arrange their own accommodation the 10th and all nights from the 15th.</p>
     <p class=\"{$pclass}\">We will not provide accommodation to anybody before the 10th or from the 20th.</p>"
  ];
  $qandas[] = [
    'The registration system has forgotten my information.',
    "<p class=\"{$pclass}\">The registration system is intentionally forgetful (This is a good thing), but it won’t forget the information it needs.</p>
     <p class=\"{$pclass}\">Let’s say you register for camp. You’d then be asked for your dietary requirements because we feed you at camp. If you now change your mind and cancel your camp registration, the system will forget what your dietary requirements are. There’s no reason to keep holding this information because we’d no longer be feeding you. So if you decide later to come to the academic dinner, you’ll need to input your dietary requirements again.</p>
     <p class=\"{$pclass}\">As soon as the system notices that some of your personal information is no longer required, it will be deleted. There are a number of reasons for this behaviour:</p>
     <ul class=\"{$pclass}\">
       <li>You can be sure that all of the personal information we hold about you is current and relevant and can be accessed and modified directly by you. You are in complete control and we don’t hide anything from you.</li>
       <li>Deleting outdated information means that it can’t accidentally be used.</li>
       <li>Our job becomes easier because we won’t have to filter out information we don’t need.</li>
     </ul>"
  ];
  $qandas[] = [
    '',
    "<p class=\"{$pclass}\"></p>"
  ];
@endphp

@section('maincontent')

@foreach($qandas as $qanda)
  <p class="{{ $headlineclass }}">{{ $qanda[0] }}</p>
  {!! $qanda[1] !!}
@endforeach

@stop