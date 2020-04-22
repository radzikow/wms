<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @include('layouts.partials.head')
</head>

<body>

  {{-- App Header --}}
  @include('layouts.partials.app-header')

  {{-- Alerts --}}
  @include('layouts.partials.alert')

  <main>
    {{-- Sidebar --}}
    @include('layouts.partials.sidebar')

    {{-- Main Content --}}
    @yield('content')
  </main>

  {{-- Footer Scripts --}}
  @include('layouts.partials.footer-scripts')

</body>

</html>
