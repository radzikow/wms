@extends('layouts.app')

@section('content')

{{-- Edit User --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/users') }}">Users</a> / <a
        href="/dashboard/users/{{ $user->id }}">Edit User</a>
    </h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Edit user</p>
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

        {{-- Form --}}
        <form id="editUserForm" class="form" action="/dashboard/users" method="POST">
          @method('PUT')
          @csrf

          {{-- firstname --}}
          <div class="form-item">
            <label for="userFirstname">Firstname</label>
            <input type="text" name="userFirstname" id="userFirstname" value="{{ old('userFirstname') ? old('userFirstname') : $user->firstname }}">
          </div>

          {{-- lastname --}}
          <div class="form-item">
            <label for="userLastname">Lastname</label>
            <input type="text" name="userLastname" id="userLastname" value="{{ old('userLastname') ? old('userLastname') : $user->lastname }}">
          </div>

          {{-- email --}}
          <div class="form-item">
            <label for="userEmail">E-mail</label>
            <input type="text" value="{{ $user->email }}" disabled>
            <input type="text" name="userEmail" id="userEmail" value="{{ old('userEmail') ? old('userEmail') : $user->email }}" hidden>
          </div>

          {{-- password --}}
          <div class="form-item">
            <label for="userPassword">New password (skip this field to keep current password)</label>
            <input class="{{ $errors->has('userPassword') ? 'has-error' :'' }}" type="password" name="userPassword"
              id="userPassword">
          </div>

          {{-- password confirm --}}
          <div class="form-item">
            <label for="userPassword_confirmation">Confirm new password</label>
            <input type="password" name="userPassword_confirmation" id="userPassword_confirmation">
          </div>

          {{-- current password --}}
          <input type="password" name="userCurrentPassword" id="userCurrentPassword" value="{{ $user->password }}"
            hidden>

          {{-- privileges --}}
          <div class="form-item">
            <label for="userPrivileges">Privileges</label>
            <select name="userPrivileges" id="userPrivileges">

              @if ($user->role === 'admin')
              <option value="admin" selected>Admin</option>
              <option value="author">Author</option>

              @else
              <option value="admin">Admin</option>
              <option value="author" selected>Author</option>
              @endif

            </select>
          </div>

          {{-- status (default: active) --}}
          {{-- status --}}
          <div class="form-item">
            <label for="userStatus">Active user?</label>
            @if (old('userStatus'))

            @if ((old('userStatus') == 'on') || (old('userStatus') == 1))
            <input class="inputStatus" name="userStatus" id="userStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="userStatus" id="userStatus" type="checkbox">
            @endif

            @else
            <input class="inputStatus" name="userStatus" id="userStatus" type="checkbox"
              {{ $oneNews->status == 1 ? 'checked' : ''}}>
            @endif
          </div>

          {{-- id --}}
          <input hidden name="userId" type="number" value="{{ $user->id }}">

          {{-- submit (hidden) --}}
          <input id="editUserBtnHidden" hidden type="submit" value="Edit User">

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick='document.getElementById("editUserForm").submit();'
          id="editUserBtnVisible">
          Update User
        </button>
      </div>

    </div>

  </div>

</div>

@endsection
