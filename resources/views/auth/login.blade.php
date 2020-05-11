@extends('layouts.welcome')

@section('content')

<div class="login-wrapper">

  <form class="login-form" id="loginForm" action="{{ route('login') }}" method="POST">
    @csrf

    <h1 class="title">Login Form</h1>

    <div class="form-item">
      <label for="email">E-mail address</label>

      <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="form-item">
      <label for="password" class="">Password</label>

      <input id="password" type="password" name="password" required autocomplete="current-password">

      @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="form-item check">
      <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

      <label class="form-check-label" for="remember">
        Remember me
      </label>
    </div>

    <div class="form-button">
      <button type="submit" class="">
        {{ __('Login') }}
      </button>
    </div>

    <div class="test-login">
      <p>
        Login using e-mail:
        <span id="mailBtn" class="tooltip">admin@mail.com
          <span class="tooltiptext mailTooltipText">Copy</span></span>
        and password:
        <span id="passBtn" class="tooltip">pass
          <span class="tooltiptext passTooltipText">Copy</span>
        </span>
      </p>
    </div>

  </form>

</div>

@endsection
