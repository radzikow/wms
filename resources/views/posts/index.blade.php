@extends('layouts.app')

@section('content')

{{-- Posts --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('dashboard/posts') }}">Blog Posts</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>All blog posts</p>
      <div class="title-buttons">
        <a href="{{ url('dashboard/posts/create') }}" class="title-button button-add"><img
            src="{{ asset('/svg/add.svg') }}" alt="Add"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      <div class="content-tables">

        <table>
          <thead class="posts-table-head">
            <tr>
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>@sortablelink('title')</th>
              <th>@sortablelink('user_id', 'Author')</th>
              <th>@sortablelink('date')</th>
              <th>@sortablelink('views', 'Views/comments')</th>
              <th>@sortablelink('topic_id', 'Topic')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $key => $post)
            <tr>
              <td><img class="td-image" src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>
              <td>{{ $post->title }}</td>
              @foreach($users as $user)
              @if ($user->id == $post->user_id)
              <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
              @endif
              @endforeach
              <td>{{ $post->date }}</td>
              <td>{{ $post->views . '/' . $post->comments }}</td>
              @foreach($topics as $topic)
              @if ($topic->id == $post->topic_id)
              <td>{{ $topic->name }}</td>
              @endif
              @endforeach
              <td><span
                  class="status {{ $post->status == 1 ? 'published' : 'unpublished' }}">{{ $post->status == 1 ? 'Published' : 'Unpublished' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/posts/{{ $post->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}" alt="Edit"></a>
                <form action="/dashboard/posts/{{$post->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure you want to delete this post?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
                {{-- TODO: show post btn --}}
                <a href="{{ url('/blog/post/{id}') }}"><img src="{{ url('/svg/show.svg') }}" alt="Show"></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- pagination --}}
      <span class="pagination">{{ $posts->links() }}</span>

    </div>

  </div>

</div>

@endsection
