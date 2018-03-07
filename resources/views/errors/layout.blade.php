<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/Webfont_kit/type.css">
    <style>
      html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'RiksWeb Normal', sans-serif;
        font-weight: normal;
        font-style: normal;
        height: 100vh;
        margin: 0;
      }
      .full-height {
        height: 100vh;
      }
      .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
      }
      .position-ref {
        position: relative;
      }
      .content {
        text-align: center;
      }
      .title {
        font-size: 72px;
        padding: 20px;
        text-transform: uppercase;
      }
      .message {
        font-size: 48px;
        padding: 20px;
      }
      .massive {
        font-size: 288px;
      }
      .flip {
        -moz-transform: scale(1, -1);
        -webkit-transform: scale(1, -1);
        -o-transform: scale(1, -1);
        -ms-transform: scale(1, -1);
        transform: scale(1, -1);
      }
    </style>
  </head>
  <body>
    <div class="flex-center position-ref full-height">
      <div class="content">
        <div class="massive flip">L&#xE001;</div>
        <div class="title">@yield('title')</div>
        @section('message', $exception->getMessage())
        @hasSection('message')
          <div class="message">@yield('message')</div>
        @endif
      </div>
    </div>
  </body>
</html>

