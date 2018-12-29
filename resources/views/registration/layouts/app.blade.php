<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }} Registration</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/stickyfooter.css') }}" rel="stylesheet">
  <link href="{{ asset('css/pagebreaks.css') }}" rel="stylesheet">
  @yield('extrastyles')
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
          {{ config('app.name') }} Registration
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li><a class="nav-link" href="{{ url('/choristers') }}">Main site</a></li>
          </ul>
          <ul class="navbar-nav ml-auto">
            @guest
              <li><a class="nav-link" href="{{ route('login') }}">Registration</a></li>
            @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->username }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu rounded-0" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="py-4">
    @yield('content')
  </main>
  <footer class="footer">
    <div class="container">
      <div class="d-flex justify-content-between">
        <div>AIVCF Adelaide</div>
        <div>
          <span class="pl-3"><a href="{{ route('help') }}">Help</a></span>
          <span class="pl-3"><a href="{{ route('privacy') }}">Privacy</a></span>
          <span class="pl-3"><a href="{{ route('privacy.summary') }}">P3</a></span>
          <span class="pl-3"><a href="{{ route('conduct') }}">Conduct</a></span>
        </div>
      </div>
    </div>
  </footer>
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('extrascripts')
</body>
</html>
