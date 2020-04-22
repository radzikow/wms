@extends('layouts.app')

@section('content')

{{-- News --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('dashboard/news') }}">News</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>All news</p>
      <div class="title-buttons">
        <a class="title-button button-add" href="{{ url('/dashboard/news/create') }}" class="action add-record"><img
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
            <tr class="news-table-head">
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>@sortablelink('date')</th>
              <th>@sortablelink('title')</th>
              <th>@sortablelink('text', 'Content')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($allNews as $key => $news)
            <tr>
              <td><img class="td-image" src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>
              <td>{{ $news->date }}</td>
              <td>{{ $news->title }}</td>
              <td>{{ substr(strip_tags(html_entity_decode($news->content)), 0, 140) . '...' }}</td>
              <td><span
                  class="status {{ $news->status === 1 ? 'published' : 'unpublished' }}">{{ $news->status === 1 ? 'Published' : 'Unpublished' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/news/{{ $news->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}" alt="Edit"></a>
                <form action="/dashboard/news/{{$news->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure you want to delete this news?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- pagination --}}
      <span class="pagination">{{ $allNews->links() }}</span>

    </div>

  </div>

</div>

@endsection
