{{-- Welcome Header --}}
<nav class="welcome-header-nav">
  <div class="container-fluid welcome-header">
    <div class="row welcome-header-wrapper">

      <div class="welcome-header-logo">
        <a href="{{ url('/') }}" class="logo-long">Website Management System ©</a>
        <a href="{{ url('/') }}" class="logo-short">WMS ©</a>
      </div>

      <div class="welcome-header-links">

        @if (Route::has('login'))
        @auth
        <a class="header-link-1" href="{{ url('/') }}">Home</a>
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else
        <a class="header-link-1" href="{{ url('/') }}">Home</a>
        <a href="{{ route('login') }}">Login<img src="{{url("/svg/login.svg")}}" alt="Login"></a>

        {{-- @if (Request::is('login'))
        <a href="{{ url('/') }}">Home</a>
        @else
        <a href="{{ route('login') }}">Login<img src="{{url("/svg/login.svg")}}" alt="Login"></a>
        @endif --}}

        @endauth
        @endif

      </div>

    </div>
  </div>
</nav>
