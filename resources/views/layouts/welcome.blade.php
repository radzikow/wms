<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @include('layouts.partials.head')
</head>

<body>

  {{-- Welcome Header --}}
  @include('layouts.partials.welcome-header')

  {{-- Alerts --}}
  @include('layouts.partials.alert')

  {{-- Main Content --}}
  @yield('content')

  {{-- Footer Scripts --}}
  @include('layouts.partials.footer-scripts')

</body>

</html>
