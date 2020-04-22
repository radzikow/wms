<?php
use App\Setting;

$settings = Setting::all();

$sidebar = Setting::where('nesting', 'Sidebar')->get();

$blog = Setting::where('nesting', 'Blog')->get();

$websiteContent = Setting::where('nesting', 'Website Content')->get();
?>

<div id="sidebarSection" class="sidebar-section">

  <div class="sidebar-wrapper">

    <button id="burgerBtn2" class="sidebar-burger">
      <p class="sidebar-burger-name">Main Navigation</p>
      <img class="burger-image" src="{{ asset("/svg/menu-dark.svg") }}" alt="Menu Burger">
    </button>

    <div class="sidebar-list">

      {{-- Dashboard --}}
      <div class="sidebar-list-item">
        <a class="sidebar-list-link" href="{{ url('/dashboard') }}">
          <img src="{{ asset("/svg/dashboard.svg") }}" alt="Dashboard">
          <p class="sidebar-list-name">Dashboard</p>
        </a>
      </div>

      {{-- Users --}}
      <div class="sidebar-list-item">
        <a class="sidebar-list-link" href="{{ url('/dashboard/users') }}">
          <img src="{{ asset("/svg/users.svg")}} " alt="Users">
          <p class="sidebar-list-name">Users</p>
        </a>
      </div>

      {{-- Website Content --}}
      <div id="websiteContentBtn" class="sidebar-list-item">
        <a class="sidebar-list-link" href="">
          <img src="{{ asset("/svg/website-content.svg") }}" alt="Website Content">
          <p class="sidebar-list-name">Website Content</p>
        </a>
      </div>

      @foreach($websiteContent as $key => $value)
      <div class="sidebar-list-item content-subpages">
        <a class="sidebar-list-link {{ $value->status === 0 ? 'disabled-link' : '' }}"
          href="{{ url('/dashboard' . '/' . $value->url) }}">
          <img src="{{ asset("/svg/angle-right.svg") }}" alt="{{ $value->name }}">
          <p class="sidebar-list-name">{{ $value->name }}</p>
        </a>
      </div>
      @endforeach

      {{-- Blog --}}
      <div id="blogBtn" class="sidebar-list-item">
        <a class="sidebar-list-link" href="">
          <img src="{{ asset("/svg/blog.svg") }}" alt="Blog">
          <p class="sidebar-list-name">Blog</p>
        </a>
      </div>

      @foreach($blog as $key => $value)
      <div class="sidebar-list-item blog-subpages">
        <a class="sidebar-list-link {{ $value->status === 0 ? 'disabled-link' : '' }}"
          href="{{ url('/dashboard' . '/' . $value->url) }}">
          <img src="{{ asset("/svg/angle-right.svg") }}" alt="{{ $value->name }}">
          <p class="sidebar-list-name">{{ $value->name }}</p>
        </a>
      </div>
      @endforeach

      {{-- Sidebar Items --}}

      @foreach($sidebar as $key => $value)
      <div class="sidebar-list-item sidebar-list-item">
        <a class="sidebar-list-link {{ $value->status === 0 ? 'disabled-link' : '' }}"
          href="{{ url('/dashboard' . '/' . $value->url) }}">

          <img src="{{ asset("/svg" . "/" . $value->icon . ".svg") }}" alt="{{ $value->name }}">

          <p class="sidebar-list-name">{{ $value->name }}</p>
        </a>
      </div>
      @endforeach

      {{-- News --}}
      {{-- <div id="newsBtn" class="sidebar-list-item">
        <a class="sidebar-list-link" href="{{ url('/dashboard/news') }}">
          <img src="{{ asset("/svg/news.svg") }}" alt="News">
          <p class="sidebar-list-name">News</p>
        </a>
      </div> --}}

      {{-- Newsletter --}}
      {{-- <div class="sidebar-list-item">
        <a class="sidebar-list-link" href="{{ url('/dashboard/newsletter') }}">
          <img src="{{ asset("/svg/newsletter.svg") }}" alt="Newsletter">
          <p class="sidebar-list-name">Newsletter</p>
        </a>
      </div> --}}

      {{-- Notifications --}}
      {{-- <div class="sidebar-list-item">
        <a class="sidebar-list-link" href="{{ url('/dashboard/activity') }}">
          <img src="{{ asset("/svg/notifications.svg") }}" alt="Notifications">
          <p class="sidebar-list-name">Activity</p>
        </a>
      </div> --}}

      {{-- Settings --}}
      <div class="sidebar-list-item">
        <a class="sidebar-list-link" href="{{ url('/dashboard/settings') }}">
          <img src="{{ asset("/svg/settings.svg") }}" alt="Settings">
          <p class="sidebar-list-name">Settings</p>
        </a>
      </div>

      {{-- Logout --}}
      <div class="sidebar-list-item">
        <a class="sidebar-list-link" href="{{ url('/logout') }}" onclick="event.preventDefault();
        document.getElementById('sidebarLogoutForm').submit();">
          <img src="{{ asset("/svg/logout.svg") }}" alt="Logout">
          <p class="sidebar-list-name">Logout</p>
          <form id="sidebarLogoutForm" action="{{ url('/logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </a>
      </div>
    </div>

    {{-- Sidebar Footer --}}
    <div class="sidebar-footer">
      <span>WMS © All Right Reserved.</span>
      <span>Version: 1.0.0</span>
    </div>

  </div>
</div>
