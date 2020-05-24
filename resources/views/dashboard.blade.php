@extends('layouts.app')

@section('content')

{{-- Dashboard --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard') }}">Dashboard</a></h1>
  </div>

  {{-- Dashboard Tiles (Analytics) --}}
  <div class="dashoard-tiles-wrapper">

    <div class="dashoard-tile-single">
      <div class="tile-left">
        <img src="{{ url('/svg/active-visitors.svg') }}" alt="Active Visitors">
      </div>
      <div class="tile-right">
        <p>ACTIVE VISITORS</p>
        <span>{{ $live_users }}</span>
      </div>
    </div>

    <div class="dashoard-tile-single">
      <div class="tile-left">
        <img src="{{ url('/svg/new-visitors.svg') }}" alt="New Visitors">
      </div>
      <div class="tile-right">
        <p>VIEWS (TODAY)</p>
        <span>{{ $visitorsToday[0]['pageViews'] }}</span>
      </div>
    </div>

    <div class="dashoard-tile-single">
      <div class="tile-left">
        <img src="{{ url('/svg/new-posts.svg') }}" alt="New Posts">
      </div>
      <div class="tile-right">
        <p>VIEWS (LAST WEEK)</p>
        <span>36</span>
      </div>
    </div>

    <div class="dashoard-tile-single">
      <div class="tile-left">
        <img src="{{ url('/svg/new-comments.svg') }}" alt="New Comments">
      </div>
      <div class="tile-right">
        <p>NEW COMMENTS</p>
        <span>{{ $commentsThisWeek }}</span>
      </div>
    </div>

  </div>

  {{-- Most Popular Posts --}}

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Most popular posts</p>
      <div class="title-buttons">
        <a href="{{ url('dashboard/posts/create') }}" class="title-button button-add"><img
            src="{{ asset('/svg/add.svg') }}" alt="Add"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      <div class="content-tables">

        <table>
          <thead class="dashboard-posts-table-head">
            <tr>
              <th>Rank</th>
              <th>Title</th>
              <th>Author</th>
              <th>Views</th>
              <th>Comments</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $key => $post)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $post->title }}</td>
              @foreach ($users as $user)
              @if ($user->id === $post->user_id)
              <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
              @endif
              @endforeach
              <td>{{ $post->views }}</td>
              <td>{{ $post->comments }}</td>
              <td><span
                  class="status {{ $post->status == 1 ? 'published' : 'unpublished' }}">{{ $post->status == 1 ? 'Published' : 'Unpublished' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/posts/{{ $post->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}" alt="Edit"></a>
                <form action="/dashboard/posts/{{$post->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button id="" onclick="return confirm('Are you sure you want to delete this post?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
                {{-- TODO: show post btn --}}
                <a href=""><img src="{{ url('/svg/show.svg') }}" alt="Show"></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- Show more btn --}}
      <div class="show-more-btn">
        <a href="{{ url('/dashboard/posts') }}">
          See all posts
          <img src="{{ url('/svg/angle-right.svg') }}" alt="Right">
        </a>
      </div>

    </div>

  </div>

  {{-- Recently Added Comments --}}

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Recently added comments</p>
      <div class="title-buttons">
        <a href="{{ url('dashboard/posts/create') }}" class="title-button button-add"><img
            src="{{ asset('/svg/add.svg') }}" alt="Add"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      <div class="content-tables">

        <table>
          <thead class="dashboard-comments-table-head">
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Nickname</th>
              <th>Text</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($comments as $key => $comment)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ date('Y-m-d', strtotime($comment->added_at)) }}</td>
              <td>{{ $comment->nickname }}</td>
              <td>{{ $comment->text }}</td>
              <td>
                @if ($comment->status == 0)
                <span class="status rejected">Rejected</span>
                @elseif($comment->status == 1)
                <span class="status accepted">Accepted</span>
                @else
                <span class="status waiting">Waiting</span>
                @endif
              </td>
              <td class="options">
                {{-- accept --}}
                <form action="/dashboard/comments/{{$comment->id}}/accept" method="POST">
                  @csrf
                  @method('PUT')
                  <button><img class="accept" src="{{ url('/svg/accept.svg') }}" alt="Accept"></button>
                </form>
                {{-- reject --}}
                <form action="/dashboard/comments/{{$comment->id}}/reject" method="POST">
                  @csrf
                  @method('PUT')
                  <button><img class="reject" src="{{ url('/svg/reject.svg') }}" alt="Reject"></button>
                </form>
                {{-- edit --}}
                <a href="/dashboard/comments/{{ $comment->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}"
                    alt="Edit"></a>
                {{-- delete --}}
                <form action="/comments/{{$comment->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button id="" onclick="return confirm('Are you sure you want to delete this comment?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- Show more btn --}}
      <div class="show-more-btn">
        <a href="{{ url('/dashboard/comments') }}">
          See all comments
          <img src="{{ url('/svg/angle-right.svg') }}" alt="Right">
        </a>
      </div>

    </div>

  </div>

</div>

@endsection
