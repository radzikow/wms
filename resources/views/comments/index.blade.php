@extends('layouts.app')

@section('content')

{{-- Comments --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/comments') }}">Blog Comments</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    <div class="content-title">
      <p>All comments</p>
      <div class="title-buttons">
        <a class="title-button button-delete" href=""><img src="{{ asset('/svg/delete2.svg') }}" alt="Delete"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content table --}}
      <div class="content-tables">

        {{-- table --}}
        <table>
          <thead class="comments-table-head">
            <tr>
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>@sortablelink('nickname')</th>
              <th>@sortablelink('post_id', 'Post')</th>
              <th>@sortablelink('text')</th>
              <th>@sortablelink('added_at', 'Date')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($comments as $key => $comment)
            <tr>
              <td><img class="td-image" src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>
              <td>{{ $comment->nickname }}</td>
              @foreach($posts as $post)
              @if ($post->id === $comment->post_id)
              <td>{{ $post->title }}</td>
              @endif
              @endforeach
              <td>{{ $comment->text }}</td>
              <td>{{ date('Y-m-d', strtotime($comment->added_at)) }}</td>
              <td>
                @if ($comment->status === 0)
                <span class="status rejected">Rejected</span>
                @elseif($comment->status === 1)
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
                <form action="/dashboard/comments/{{$comment->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure you want to delete this comment?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- pagination --}}
      <span class="pagination">{{ $comments->links() }}</span>

    </div>

  </div>

</div>

@endsection
