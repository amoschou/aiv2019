@extends ('public.layouts.base')


@section ('gridblock')

{{--
  --  First card (Concert details)
  --}}
    <div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp portfolio-card">
      <div class="mdl-card__media">
        <!--
          Photograph by Michael Coghlan https://www.flickr.com/photos/mikecogh/16645424040/
          With licence https://creativecommons.org/licenses/by-sa/2.0/
          Modified by crop to change aspect ratio.
        -->
        <img class="article-image" src="/style/css/images/stpeterscathedral-384x256.jpg" border="0" alt="">
      </div>
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Concert</h2>
      </div>
      <div class="mdl-card__supporting-text">
      The festival concert ‘Northern lights’ will be on Saturday, 19 January 2019.
      </div>
      <div class="mdl-card__actions mdl-card--border">
        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="/concert">Read more</a>
      </div>
    </div>
  
{{--
  --  Second card (Choir participation)
  --}}
<div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp portfolio-card">
  <div class="mdl-card__media">
    <!-- Photograph by Lou McGee -->
    <img class="article-image" src="/style/css/images/rehearsal2013-384x256.jpg" border="0" alt="">
  </div>
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Choristers</h2>
  </div>
  <div class="mdl-card__supporting-text">
    Choristers from all over Australia are taking part in the festival.
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="/documents/newsbulletins/aurora-adelaideiv2019.pdf">Download information</a><br>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="/participate/choir">Read more</a><br>
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="/home">Sign up</a>
  </div>
</div>

{{--
  --  Third card (Connect)
  --}}
<div class="mdl-cell mdl-cell--4-col mdl-card mdl-shadow--4dp portfolio-card">
  <div class="mdl-card__media">
    <img class="article-image" src="/style/css/images/aiv2013-384x256.jpg" border="0" alt="">
  </div>
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Connect</h2>
  </div>
  <div class="mdl-card__supporting-text">
    There are a number of ways to support the festival. Find out what you can do.
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="/participate">Read more</a>
  </div>
</div>


{{--
  --  About Adelaide IV general text
  --}}
<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
  @section('cardtitle')
    @if(isset($titletext))
      <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">{{ $titletext }}</h2>
      </div>
    @endif
  @show
  @section('cardmedia')
    @if (False && isset($imagesource))
      <div class="mdl-card__media">
        <img class="article-image" src="{% static '' %}{{ $imagesource }}" border="0" alt="">
      </div>
    @endif
  @show
  <div class="mdl-grid portfolio-copy">
    <div class="mdl-cell mdl-cell--12-col mdl-card__supporting-text no-padding ">
      @if(isset($essay))
        @foreach ($essay as $section)
            <h3 class="mdl-typography--headline">{{ $section[0] }}</h3>
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
    </div>
  </div>
</div>




@stop
