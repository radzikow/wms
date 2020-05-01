@extends('layouts.app')

@section('content')

{{-- Edit Comment --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/comments') }}">Blog comments</a> / <a
        href="/dashboard/comments/{{ $comment->id }}">Edit
        Comment</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Edit comment</p>
    </div>

    {{-- Content --}}
    <div class="content">

      <div class="content-forms">

        {{-- Form --}}
        <form id="editCommentForm" class="form" method="POST" action="/dashboard/comments">
          @method('PUT')
          @csrf

          {{-- nickname --}}
          <div class="form-item">
            <label for="commentNickname">Nickname</label>
            <input type="text" name="commentNickname" id="commentNickname" value="{{ $comment->nickname }}" disabled>
          </div>

          {{-- firstname --}}
          <div class="form-item">
            <label for="commentFirstname">Firstname</label>
            <input type="text" name="commentFirstname" id="commentFirstname" value="{{ $comment->firstname }}" disabled>
          </div>

          {{-- lastname --}}
          <div class="form-item">
            <label for="commentLastname">Lastname</label>
            <input type="text" name="commentLastname" id="commentLastname" value="{{ $comment->lastname }}" disabled>
          </div>

          {{-- post title --}}
          <div class="form-item">
            <label for="commentPost">Post title</label>
            @foreach($posts as $key => $post)
            @if($post->id === $comment->post_id)
            <input type="text" name="" id="" value="{{ $post->title }}" disabled>
            <input type="text" name="commentPost" id="commentPost" value="{{ $comment->post_id }}" hidden disabled>
            @endif
            @endforeach
          </div>

          {{-- comment text --}}
          <div class="form-item">
            <label for="commentText">Text</label>
            <input type="text" name="commentText" id="commentText" value="{{ $comment->text }}">
          </div>

          {{-- date --}}
          <div class="form-item">
            <label for="commentDate">Date</label>
            <input type="date" name="commentDate" id="commentDate" value="{{ $comment->added_at }}" disabled>
          </div>

          {{-- likes --}}
          <div class="form-item">
            <label for="commentLikes">Likes</label>
            <input type="number" name="commentLikes" id="commentLikes" value="{{ $comment->likes }}" disabled>
          </div>

          {{-- status --}}
          <div class="form-item">
            <label for="commentStatus">Comment status</label>
            <select name="commentStatus" id="commentStatus">
              <option value="" disabled hidden>Choose status</option>
              <option value="2" {{ $comment->status == 2 ? 'selected' : '' }}>Waiting</option>
              <option value="1" {{ $comment->status == 1 ? 'selected' : '' }}>Accepted</option>
              <option value="0" {{ $comment->status == 0 ? 'selected' : '' }}>Rejected</option>
            </select>
          </div>

          {{-- id --}}
          <input hidden name="commentId" type="number" value="{{ $comment->id }}">

          {{-- hidden submit --}}
          <input type="submit" value="Update Comment" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('editCommentForm').submit();">Update
          Comment</button>
      </div>

    </div>

  </div>

</div>

@endsection
