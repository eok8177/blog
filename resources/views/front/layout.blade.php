<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="{{ asset('assets/admin.css').'?'.time() }}">
  @stack('styles')
</head>

<body>
  <div class="container pt-2">


    @yield('content')

  </div>

</div>

@stack('scripts')
</body>
</html>
