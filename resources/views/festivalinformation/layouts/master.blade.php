<!DOCTYPE html>
<!--
  Copyright 2016 Google Inc. All rights reserved.

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
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }} {{ $fibsacronymasaname }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/images/logo_components_color_2x_web_48dp.png">
    <link rel="stylesheet" href="//material-components-web.appspot.com/assets/typography.css">
    <link rel="stylesheet" href="//material-components-web.appspot.com/assets/drawer/drawer.css">
    <link rel="stylesheet" href="//material-components-web.appspot.com/assets/radio.css">
    <link rel="stylesheet" href="//material-components-web.appspot.com/assets/tabs.css">
    <link rel="stylesheet" href="//material-components-web.appspot.com/assets/select.css">
    <script src="//material-components-web.appspot.com/ready.js"></script>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto+Mono">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500">
    <link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <style>
      .demo-body {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      .demo-main {
        padding-left: 16px;
        padding-right: 16px;
        padding-bottom: 16px;
        overflow: auto;
      }
    </style>
    @yield('extrastyle')
    @yield('styleforselect')
  </head>
  <body class="mdc-typography">
    <div class="mdc-toolbar">
      <div class="mdc-toolbar__row">
        <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
          <button class="demo-menu material-icons mdc-toolbar__menu-icon">menu</button>
          @section('backbutton')
            <a href="/{{ $fibsacronymlc }}" class="catalog-back mdc-toolbar__menu-icon"><i class="material-icons">&#xE5C4;</i></a>
          @show
          <span class="mdc-toolbar__title">@yield('toolbartitle')</span>
        </section>
      </div>
    </div>
    <aside class="mdc-drawer mdc-drawer--temporary demo-drawer">
      <nav class="mdc-drawer__drawer">
        <header class="mdc-drawer__header">
          @include('festivalinformation.layouts.drawer.header')
        </header>
        <nav class="mdc-drawer__content mdc-list-group">
          @include('festivalinformation.layouts.drawer.nav')
        </nav>
      </nav>
    </aside>
    <main class="demo-main">
      @yield('basictabbar')
      @yield('maincontent')
    </main>
    <script src="//material-components-web.appspot.com/assets/material-components-web.js" async></script>
    <script src="//material-components-web.appspot.com/assets/common.js" async></script>
    {{-- Script for Drawer --}}
    <script>
      demoReady(function() {
        var drawerEl = document.querySelector('.mdc-drawer');
        var MDCTemporaryDrawer = mdc.drawer.MDCTemporaryDrawer;
        var drawer = new MDCTemporaryDrawer(drawerEl);
        document.querySelector('.demo-menu').addEventListener('click', function() {
          drawer.open = true;
        });

        // Demonstrate application of --activated modifier to drawer menu items
        var activatedClass = 'mdc-list-item--selected';
        document.querySelector('.mdc-drawer__drawer').addEventListener('click', function(event) {
          var el = event.target;
          while (el && !el.classList.contains('mdc-list-item')) {
            el = el.parentElement;
          }
          if (el) {
            var activatedItem = document.querySelector('.' + activatedClass);
            if (activatedItem) {
              activatedItem.classList.remove(activatedClass);
            }
            event.target.classList.add(activatedClass);
          }
        });

      });
    </script>
    @yield('scriptfortabs')
    @yield('scriptforselect')
  </body>
</html>
