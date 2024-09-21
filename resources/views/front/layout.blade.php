<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="{{ asset('assets/front.css').'?'.time() }}">
  @stack('styles')
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="{{ locale_route('front.home') }}">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <div class="select-lang">
        <a href="{{$link_ua ?? ''}}" class="@if(app()->getLocale() == 'ua')active @endif">{{__('ua')}}</a> <span>|</span> <a href="{{$link_en ?? ''}}" class="@if(app()->getLocale() == 'en')active @endif">{{__('en')}}</a>
      </div>
    </nav>
    <h1 class="title">
      Blog Title
    </h1>
  </header>
  <div class="container">

    <div class="grid">
      <div class="main">
        @yield('content')
      </div>
      <div class="sidebar">
        Sidebar
      </div>
    </div>



  </div>
</div>

@stack('scripts')
</body>
</html>
