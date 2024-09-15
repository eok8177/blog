<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  {{-- @vite(['resources/css/admin.scss']) --}}

  <link rel="stylesheet" href="{{ asset('assets/admin.css').'?'.time() }}">
  @stack('styles')
</head>

<body>

  <div id="app" class="menu-closed">

    {{-- Navigation --}}
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
      <div class="container-fluid">

        <div class="navbar-nav flex-row">

          <button type="button" class="menu-toggler nav-link" onclick="document.getElementById('app').classList.toggle('menu-closed');"><span class="navbar-toggler-icon"></span></button>

          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link">{{ __('Dashboard') }}</a>
          </li>
          <li class="nav-item d-none d-md-block">
            <a href="{{route('admin.blog-category.index')}}" class="nav-link"><i class="fa fa-book"></i> {{ __('Blog Categories') }}</a>
          </li>

        </div>

        <ul class="navbar-nav flex-row">

          <li class="nav-item me-2  d-none d-md-block">
            <a href="/" class="nav-link" target="_blank"><i class="fa fa-home"></i> <span class="d-none d-xl-inline">{{ __('to Site') }}</span></a>
          </li>

          <li class="nav-item dropdown">

            <a href="#" class="nav-link dropdown-toggle  d-none d-md-block" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ auth()->user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              <a href="{{route('admin.user.edit',auth()->user())}}" class="dropdown-item">
                <i class="fa fa-user"></i> {{ __('Profile') }}
              </a>

              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="{{route('admin.user.create')}}">
                <i class="fa fa-user-o"></i> {{ __('New User') }}
              </a>
              <a class="dropdown-item" href="{{route('admin.user.index')}}">
                <i class="fa fa-users"></i> {{ __('All Users') }}
              </a>

              <div class="dropdown-divider"></div>

              <a href="{{ route('logout') }}" class="dropdown-item"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> {{ __('Logout') }}
              </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
          </div>
        </li>

      </ul>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    </div>

    {{-- SIDEBAR --}}
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav flex-column side-nav">
        <hr>

        <a href="/" class="nav-item nav-link ps-2 d-md-none" target="_blank">
          <i class="fa fa-home"></i> {{ __('to Site') }}
        </a>

        <hr class="d-md-none">

        <a href="{{route('admin.blog-category.index')}}" class="nav-item nav-link ps-2">
          <i class="fa fa-book"></i> {{ __('Blog Categories') }}
        </a>

        <hr class="d-md-none">

        <a href="{{route('admin.user.edit',auth()->user())}}" class="d-md-none nav-item nav-link ps-2">
          <i class="fa fa-user"></i> {{ __('Profile') }}
        </a>

        <a class="d-md-none nav-item nav-link ps-2" href="{{route('admin.user.index')}}">
          <i class="fa fa-users"></i> {{ __('All Users') }}
        </a>

        <hr class="d-md-none">

        <a href="{{ route('logout') }}" class="d-md-none nav-item nav-link ps-2"
          onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="fa fa-sign-out"></i> {{ __('Logout') }}
        </a>

      </div>
    </div>
  </nav>

  {{--  PAGE  --}}
  <div id="page-wrapper">
    <div class="container-fluid pt-2">

      <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has($msg))
        <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
          {{ Session::get($msg) }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @endforeach

        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>

      @yield('content')

    </div>
  </div>

</div>

<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('assets/admin2.js').'?'.time() }}"></script>
@stack('scripts')
</body>
</html>
