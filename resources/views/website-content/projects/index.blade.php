@extends('layouts.app')

@section('content')

{{-- Projects --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('dashboard/projects') }}">Projects</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>All projects</p>
      <div class="title-buttons">
        <a class="title-button button-add" href="{{ url('/dashboard/projects/create') }}" class="action add-record"><img
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
            <tr class="projects-table-head">
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>@sortablelink('title')</th>
              <th>@sortablelink('company')</th>
              <th>@sortablelink('btn_link', 'Link')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($projects as $key => $project)
            <tr>
              <td><img class="td-image" src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>
              <td>{{ $project->title }}</td>
              <td>{{ $project->company }}</td>
              <td>{{ $project->btn_link }}</td>
              <td><span
                  class="status {{ $project->status === 1 ? 'published' : 'unpublished' }}">{{ $project->status === 1 ? 'Published' : 'Unpublished' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/projects/{{ $project->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}"
                    alt="Edit"></a>
                <form action="/dashboard/projects/{{$project->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button id="" onclick="return confirm('Are you sure you want to delete this project?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- pagination --}}
      <span class="pagination">{{ $projects->links() }}</span>

    </div>

  </div>

</div>

@endsection
