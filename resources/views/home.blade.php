@extends('layouts.welcome')

@section('content')

<div class="welcome-wrapper">
  <div class="row">
    <div class="text">
      <h2>Welcome to</h2>
      <h1>Website Management System</h1>
    </div>
    <div class="button">
      <p>Click below to login</p>
      <a href="{{ route('login') }}">Login</a>
    </div>
  </div>
</div>

@endsection
