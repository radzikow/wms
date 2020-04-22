@extends('layouts.welcome')

@section('content')

<div class="register-wrapper">

  <form class="register-form" method="POST" action="{{ route('register') }}">
    @csrf

    <h1 class="title">Register Form</h1>

    <div class="form-item">
      <label for="firstname">Firstname</label>

      <input id="firstname" type="text" class="@error('firstname') is-invalid @enderror" name="firstname"
        value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

      @error('firstname')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="form-item">
      <label for="lastname">Lastname</label>

      <input id="lastname" type="text" class="@error('lastname') is-invalid @enderror" name="lastname"
        value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

      @error('lastname')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="form-item">
      <label for="email">E-mail address</label>

      <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email">

      @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="form-item">
      <label for="password">Password</label>

      <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password"
        required autocomplete="new-password">

      @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="form-item">
      <label for="password-confirm">Confirm password</label>

      <input id="password-confirm" type="password" name="password_confirmation" required
        autocomplete="new-password">
    </div>

    <div class="form-button">
      <button type="submit" class="btn btn-primary">
        {{ __('Register') }}
      </button>
    </div>
  </form>

</div>

@endsection
