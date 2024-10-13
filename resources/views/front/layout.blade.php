<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $seo_title }}</title>

  <meta name="description" content="{{ $seo_description }}">
  <meta name="keywords" content="{{ $seo_keywords }}">

  @stack('head')

  <link rel="stylesheet" href="{{ asset('assets/front.css').'?'.time() }}">
  @stack('styles')
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="{{ locale_route('front.home') }}">{{ __('Home') }}</a></li>
        @foreach($menu_pages as $menu_page)
        <li><a href="{{ locale_route('front.page', $menu_page->slug) }}">{{ $menu_page->title }}</a></li>
        @endforeach
      </ul>
      <div class="select-lang">
        <a href="{{$lang_link_ua ?? ''}}" class="@if(app()->getLocale() == 'ua')active @endif">{{__('ua')}}</a> <span>|</span> <a href="{{$lang_link_en ?? ''}}" class="@if(app()->getLocale() == 'en')active @endif">{{__('en')}}</a>
      </div>
    </nav>
  </header>

  <div class="container">

    <div class="grid">
      <div class="main">
        @yield('content')
      </div>
      <div class="sidebar">
        <h3>{{ __('Categories') }}</h3>
        <ul class="v-nav">
          @foreach($menu_categories as $menu_category)
          <li>
            <a href="#">{{ $menu_category->title }}</a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>

  </div>
</div>

@stack('scripts')
</body>
</html>
