{{-- Welcome Header --}}
<nav class="app-header-nav">
  <div class="container-fluid app-header">
    <div class="row app-header-wrapper">

      <div class="app-header-burger">
        <img id="burgerBtn1" src="{{ asset("/svg/menu-light.svg") }}" alt="Menu Burger">
      </div>

      <div class="app-header-logo">
        <a href="{{ url('/dashboard') }}" class="logo-long">Website Management System ©</a>
        <a href="{{ url('/dashboard') }}" class="logo-short">WMS ©</a>
      </div>

      <div class="app-header-user">
        <div>
          <p>{{ Auth::user() ? Auth::user()->email : '' }}</p>
          <img src="{{ asset("/svg/user.svg") }}" alt="User Options" class="user">
          <img src="{{ asset("/svg/arrow-dropdown.svg") }}" alt="User Options" class="dropdown">

          <span id="menuOptionsDiv" class="menu-options-div">
            <ul>

              <!-- Authentication Links -->
              <a href="{{ url('/') }}">
                <li>
                  <img src="{{ asset("/svg/angle-right.svg") }}" alt="User Options" class="user">
                  <span>Home</span>
                </li>
              </a>

              <a href="{{ url('/dashboard/profile') }}">
                <li>
                  <img src="{{ asset("/svg/angle-right.svg") }}" alt="User Options" class="user">
                  <span>Profile</span>
                </li>
              </a>

              <a href="{{ url('/logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <li>
                  <img src="{{ asset("/svg/angle-right.svg") }}" alt="User Options" class="user">
                  <span>Logout</span>
                </li>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </a>

            </ul>
          </span>

        </div>
      </div>

    </div>
  </div>
</nav>
