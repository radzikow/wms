@extends('layouts.app')

@section('content')

{{-- Profile --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/profile') }}">Profile</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    <div class="content-title">
      <p>User details</p>
    </div>

    <div class="content-select">
      <div id="updateProfileInfoBtn" class="select-tab active">Update Profile
      </div>
      <div id="updateProfilePassBtn" class="select-tab">Change Password
      </div>
    </div>

    {{-- errors --}}
    @if ($errors->any())
    <div class="content-errors">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    {{-- Content / Update Profile Info --}}
    <div id="updateProfileInfo" class="content">

      <div class="content-forms">

        {{-- form --}}
        <form class="form" id="updateProfileInfoForm" action="/dashboard/profile/info" method="POST">
          @method('PUT')
          @csrf

          {{-- firstname --}}
          <div class="form-item">
            <label for="firstname">Firstname</label>
            <input class="{{ $errors->has('firstname') ? 'has-error' :'' }}" name="firstname" type="text" value="{{ old('firstname') ? old('firstname') : $user->firstname }}" id="firstname">
          </div>

          {{-- lastname --}}
          <div class="form-item">
            <label for="lastname">Lastname</label>
            <input class="{{ $errors->has('lastname') ? 'has-error' :'' }}" name="lastname" type="text" value="{{ old('lastname') ? old('lastname') : $user->lastname }}" id="lastname">
          </div>

          {{-- e-mail --}}
          <div class="form-item">
            <label for="email">E-mail</label>
            <input class="{{ $errors->has('email') ? 'has-error' :'' }}" name="email" type="text" value="{{ old('email') ? old('email') : $user->email }}" id="email">
          </div>

          {{-- hidden submit --}}
          <input type="submit" value="Update Profile" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success"
          onclick="document.getElementById('updateProfileInfoForm').submit();">Update
          Information</button>
      </div>

    </div>

    {{-- ============================= --}}
    {{-- Content / Update Profile Pass --}}
    <div id="updateProfilePass" class="content content-hidden">

      <div class="content-forms">

        {{-- form --}}
        <form class="form" id="updateProfilePassForm" action="/dashboard/profile/pass" method="POST">
          @method('PUT')
          @csrf

          {{-- current password --}}
          <div class="form-item">
            <label for="currentPassword">Current password</label>
            <input class="{{ $errors->has('currentPassword') ? 'has-error' :'' }}" name="currentPassword" type="password" value="{{ old('currentPassword') }}" id="currentPassword">
          </div>

          {{-- new password --}}
          <div class="form-item">
            <label for="newPassword">New password</label>
            <input class="{{ $errors->has('newPassword') ? 'has-error' :'' }}" type="password" name="newPassword" value="{{ old('newPassword') }}" id="newPassword">
          </div>

          {{-- new password confirmation --}}
          <div class="form-item">
            <label for="newPassword_confirmation">Repeat new password</label>
            <input class="{{ $errors->has('newPassword_confirmation') ? 'has-error' :'' }}" name="newPassword_confirmation" type="password" value="{{ old('newPassword_confirmation') }}" id="newPassword_confirmation">
          </div>

          {{-- hidden submit --}}
          <input type="submit" value="Update Profile" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success"
          onclick="document.getElementById('updateProfilePassForm').submit();">Update
          Password</button>
      </div>

    </div>

  </div>

</div>

@endsection
