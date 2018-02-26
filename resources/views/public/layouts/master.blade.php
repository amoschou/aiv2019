<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

    https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<!--
  Original source is available from
  
    https://getmdl.io/templates/portfolio/about.html.
  
  Modified by Andrew Gilbert Moschou.
  Modifications Copyright © Andrew Gilbert Moschou 2016.
-->
<!--
  According to
  
    https://github.com/google/material-design-lite/blob/mdl-1.x/LICENSE
  
  This file is also licensed under the Created Commons Attribution International
  4.0 Licence, which full text can be found here:
  https://creativecommons.org/licenses/by/4.0/legalcode.
-->
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="A site for Australian intervarsity choral festivals.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>70th AIVCF, Adelaide 2019</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.purple-deep_purple.min.css" />
  <link rel="stylesheet" href="{{ asset('style/css/style.css') }}" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  @yield('jqueryscript')
  @yield('stripescript')
  {{--  To best leverage Stripe’s advanced fraud functionality, include this script on
    --  every page on your site, not just the checkout page. Including the script on every
    --  page allows Stripe to detect anomalous behavior that may be indicative of fraud as
    --  users browse your website.
    --}}
  <script src="https://js.stripe.com/v3/"></script>
  @yield('scriptadditions')
</head>
<body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    @include('public.layouts.headernav')
    <main class="mdl-layout__content">
      @section('toast')
      @show
      <div class="mdl-grid portfolio-max-width @yield('class')">
        @if(!isset($displayfeatureblock) || $displayfeatureblock == True)
          @yield('featureblock')
        @endif
        @section('gridblock')
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
                @yield('cellsupportingtext')
              </div>
            </div>
          </div>
        @show
      </div>
      @include('public.layouts.footer')
    </main>
  </div>
  <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
</body>
</html>
