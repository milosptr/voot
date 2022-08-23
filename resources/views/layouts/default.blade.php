<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="icon" href="/favicon.png" sizes="any">
      <link rel="shortcut icon" href="/favicon.png" sizes="any">
      <link rel="apple-touch-icon" href="/apple-touch-icon.png">

      <title>Voot | @yield('title')</title>

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&=Lora:ital,wght@0,400;1,500&display=swap" rel="stylesheet">
      @vite('resources/js/app.js')
  </head>
  <body>
    @if(!Route::is('login') && !Route::is('register'))
      @include('web.navigation')
    @endif
    @yield('content')
    @if(!Route::is('login') && !Route::is('register'))
      @include('web.footer')
    @endif
  </body>
</html>
