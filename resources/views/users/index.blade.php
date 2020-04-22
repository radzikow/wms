@extends('layouts.app')

@section('content')

{{-- Users --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/users') }}">Users</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    <div class="content-title">
      <p>All registered users</p>
      <div class="title-buttons">
        <a class="title-button button-add" href="{{ url('/dashboard/users/create') }}" class="action add-record"><img
            src="{{ asset('/svg/add.svg') }}" alt="Add"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content table --}}
      <div class="content-tables">

        {{-- table --}}
        <table>
          <thead>
            <tr class="users-table-head">
              <th>#</th>
              <th>@sortablelink('firstname')</th>
              <th>@sortablelink('lastname')</th>
              <th>@sortablelink('email')</th>
              <th>@sortablelink('role')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $key => $user)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $user->firstname }}</td>
              <td>{{ $user->lastname }}</td>
              <td>{{ $user->email }}</td>
              <td class="{{ $user->role }}">{{ ucfirst($user->role) }}</td>
              <td><span
                  class="status {{ $user->status === 1 ? 'active' : 'inactive' }}">{{ $user->status === 1 ? 'Active' : 'Inactive' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/users/{{ $user->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}" alt="Edit"></a>
                <form action="/dashboard/users/{{ $user->id }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure you want to delete this user?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- Pagination --}}
      <span class="pagination">{{ $users->links() }}</span>

    </div>

  </div>

</div>

</div>

@endsection
