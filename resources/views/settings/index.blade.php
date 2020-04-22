@extends('layouts.app')

@section('content')

{{-- Settings --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/settings') }}">Settings</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    <div class="content-title">
      <p>Manage main navigation</p>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- table --}}
      <div class="content-tables">

        <table>
          <thead class="settings-table-head">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach($settings as $key => $setting)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $setting->nesting === 'Sidebar' ? $setting->name : $setting->nesting . ' / ' . $setting->name }}</td>
              <td><span
                  class="status {{ $setting->status === 1 ? 'active' : 'inactive' }}">{{ $setting->status === 1 ? 'Active' : 'Inactive' }}</span>
              </td>
              <td class="options">
                {{-- make active --}}
                <form action="/dashboard/settings/{{$setting->id}}/active" method="POST">
                  @csrf
                  @method('PUT')
                  <button><img class="active" src="{{ url('/svg/accept.svg') }}" alt="Active"></button>
                </form>
                {{-- make inactive --}}
                <form action="/dashboard/settings/{{$setting->id}}/inactive" method="POST">
                  @csrf
                  @method('PUT')
                  <button><img class="inactive" src="{{ url('/svg/reject.svg') }}" alt="Inactive"></button>
                </form>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>

      </div>

    </div>

  </div>

</div>

@endsection
