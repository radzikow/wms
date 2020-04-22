@extends('layouts.app')

@section('content')

{{-- Edit Post --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/posts') }}">Blog Posts</a> / <a
        href="{{ url('/dashboard/posts/create') }}">New
        Post</a></h1>
  </div>

  {{-- Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Add new post</p>
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

      <div class="content-forms">

        {{-- form --}}
        <form class="form" action="/dashboard/posts" method="POST" id="addPostForm" enctype="multipart/form-data">
          @csrf

          {{-- title --}}
          <div class="form-item">
            <label for="postTitle">Title</label>
            <input class="{{ $errors->has('postTitle') ? 'has-error' :'' }}" type="text" name="postTitle" id="postTitle"
              value="{{ old('postTitle') }}">
          </div>

          {{-- topic --}}
          <div class="form-item">
            <label for="postTopic">Topic</label>
            <select class="{{ $errors->has('postTopic') ? 'has-error' :'' }}" name="postTopic" id="postTopic">
              <option value="" selected disabled hidden>Choose topic</option>
              @foreach($topics as $topic)
              <option value="{{ $topic->id }}" {{ old('postTopic') === $topic->name ? 'selected' :'' }}>
                {{ $topic->name }}</option>
              @endforeach
            </select>
          </div>

          {{-- tags --}}
          <div class="form-item">
            <label for="postTags">Tags (seperate by space)</label>
            <input class="{{ $errors->has('postTags') ? 'has-error' :'' }}" type="text" name="postTags" id="postTags"
              value="{{ old('postTags') }}">
          </div>

          {{-- short text --}}
          <div class="form-item">
            <label for="postShort">Short text</label>
            <textarea class="{{ $errors->has('postShort') ? 'has-error' :'' }}" name="postShort" id="postShort"
              cols="30" rows="5">{{ old('postShort') }}</textarea>
            <script>
              CKEDITOR.replace( 'postShort' );
            </script>
          </div>

          {{-- long text / editor --}}
          <div class="form-item">
            <label for="postLong">Long text</label>
            <textarea class="{{ $errors->has('postLong') ? 'has-error' :'' }}" name="postLong" id="postLong" cols="30"
              rows="25">{{ old('postLong') }}</textarea>
            <script>
              CKEDITOR.replace( 'postLong' );
            </script>
          </div>

          {{-- image --}}
          <div class="form-item">
            <label for="postImage">Upload main image</label>
            <input class="{{ $errors->has('postImage') ? 'has-error' :'' }}" type="file" name="postImage"
              id="postImage">
          </div>

          {{-- author --}}
          <div class="form-item">
            <label for="postAuthor">Author</label>
            <select class="{{ $errors->has('postAuthor') ? 'has-error' :'' }}" name="postAuthor" id="postAuthor">
              <option value="" selected disabled hidden>Choose author</option>
              @foreach($users as $user)
              <option value="{{ $user->id }}"
                {{ old('postAuthor') === $user->firstname . ' ' . $user->lastname ? 'selected' :'' }}>
                {{ $user->firstname . ' ' . $user->lastname }}
              </option>
              @endforeach
            </select>
          </div>

          {{-- date --}}
          <div class="form-item">
            <label for="postDate">Date</label>
            <input class="{{ $errors->has('postDate') ? 'has-error' :'' }}" type="date" name="postDate" id="postDate"
              value="{{ old('postDate') }}">
          </div>

          {{-- status --}}
          <div class="form-item">
            <label for="postStatus">Publish post?</label>
            @if (old('postStatus') === 'on')
            <input class="inputStatus" name="postStatus" id="postStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="postStatus" id="postStatus" type="checkbox">
            @endif
          </div>

          {{-- hidden submit --}}
          <input type="submit" value="Add Post" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('addPostForm').submit();">Add
          Post</button>
      </div>

    </div>

  </div>

</div>

@endsection
