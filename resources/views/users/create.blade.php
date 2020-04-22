@extends('layouts.app')

@section('content')

{{-- Add User --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/users') }}">Users</a> / <a
        href="{{ url('/dashboard/users/create') }}">Add
        User</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Add new user</p>
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

    {{-- Content --}}
    <div class="content">

      {{-- content form --}}
      <div class="content-forms">

        {{-- form --}}
        <form class="form" action="/dashboard/users" method="POST" name="myform" id="addUserForm">
          @csrf

          {{-- firstname --}}
          <div class="form-item">
            <label for="userFirstname">Firstname</label>
            <input class="{{ $errors->has('userFirstname') ? 'has-error' :'' }}" type="text" name="userFirstname"
              id="userFirstname" value="{{ old('userFirstname') }}">
          </div>

          {{-- lastname --}}
          <div class="form-item">
            <label for="userLastname">Lastname</label>
            <input class="{{ $errors->has('userLastname') ? 'has-error' :'' }}" type="text" name="userLastname"
              id="userLastname" value="{{ old('userLastname') }}">
          </div>

          {{-- email --}}
          <div class="form-item">
            <label for="userEmail">E-mail</label>
            <input class="{{ $errors->has('userEmail') ? 'has-error' :'' }}" type="text" name="userEmail" id="userEmail"
              value="{{ old('userEmail') }}">
          </div>

          {{-- password --}}
          <div class="form-item">
            <label for="userPassword">Password</label>
            <input class="{{ $errors->has('userPassword') ? 'has-error' :'' }}" type="password" name="userPassword"
              id="userPassword">
          </div>

          {{-- password confirm --}}
          <div class="form-item">
            <label for="userPassword_confirmation">Confirm Password</label>
            <input type="password" name="userPassword_confirmation" id="userPassword_confirmation">
          </div>

          {{-- privileges --}}
          <div class="form-item">
            <label for="userPrivileges">Privileges</label>
            <select name="userPrivileges" id="userPrivileges">
              @if (old('userPrivileges') === 'admin')
              <option value="admin" selected>Admin</option>
              <option value="author">Author</option>
              @else
              <option value="admin">Admin</option>
              <option value="author" selected>Author</option>
              @endif
            </select>
          </div>

          {{-- status (default: active) --}}
          <div class="form-item">
            <label for="userStatus">Active user?</label>
            @if (old('userStatus') === 'on')
            <input class="inputStatus" name="userStatus" id="userStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="userStatus" id="userStatus" type="checkbox">
            @endif
          </div>

          {{-- submit (hidden) --}}
          <input type="submit" value="Add User" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('addUserForm').submit();">Add User</button>
      </div>

    </div>

  </div>

</div>

@endsection
