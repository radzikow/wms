@extends('layouts.app')

@section('content')

{{-- Topics --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/topics') }}">Blog Topics</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    <div class="content-title">
      <p>All blog topics</p>
      <div class="title-buttons">
        <a class="title-button button-add" href="{{ url('/dashboard/topics/create') }}" class="action add-record"><img
            src="{{ asset('/svg/add.svg') }}" alt="Add"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content table --}}
      <div class="content-tables">

        <table>
          <thead class="topics-table-head">
            <tr>
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>@sortablelink('name')</th>
              <th>@sortablelink('description')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($topics as $key => $topic)
            <tr>
              <td><img src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>
              <td>{{ $topic->name }}</td>
              <td>{{ $topic->description }}</td>
              <td><span
                  class="status {{ $topic->status == 1 ? 'active' : 'inactive' }}">{{ $topic->status == 1 ? 'Active' : 'Inactive' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/topics/{{ $topic->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}" alt="Edit"></a>
                <form action="/dashboard/topics/{{ $topic->id }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure you want to delete this topic?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- Pagination --}}
      <span class="pagination">{{ $topics->links() }}</span>

    </div>

  </div>

</div>

@endsection
