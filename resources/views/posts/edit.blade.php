@extends('layouts.app')

@section('content')

{{-- Edit Post --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/posts') }}">Blog Posts</a> / <a
        href="/dashboard/posts/{{ $post->id }}">Edit
        Post</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Edit post</p>
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
        <form id="editPostForm" class="form" method="POST" action="/dashboard/posts" enctype="multipart/form-data">
          @method('PUT')
          @csrf

          {{-- title --}}
          <div class="form-item">
            <label for="postTitle">Title</label>
            <input type="text" name="postTitle" id="postTitle" value="{{ old('postTitle') ? old('postTitle') : $post->title }}">
          </div>

          {{-- topic --}}
          <div class="form-item">
            <label for="postTopic">Topic</label>
            <select class="{{ $errors->has('postTopic') ? 'has-error' :'' }}" name="postTopic" id="postTopic">
              <option value="" disabled hidden>Choose topic</option>
              @foreach($topics as $topic)
              @if (old('postTopic'))
              <option value="{{ $topic->id }}" {{ old('postTopic') == $topic->id ? 'selected' :'' }}>{{ $topic->name }}
              </option>
              @else
              <option value="{{ $topic->id }}" {{ $topic->id == $post->topic_id ? 'selected' :'' }}>{{ $topic->name }}
              </option>
              @endif
              @endforeach
            </select>
          </div>

          {{-- tags --}}
          <div class="form-item">
            <label for="postTags">Tags (seperate by space)</label>
            <input type="text" name="postTags" id="postTags" value="{{ old('postTags') ? old('postTags') : $post->tags }}">
          </div>

          {{-- short text --}}
          <div class="form-item">
            <label for="postShort">Short text</label>
            <textarea name="postShort" id="postShort" cols="30" rows="5">{{ old('postShort') ? old('postShort') : $post->short_text }}</textarea>
            <script>
              CKEDITOR.replace( 'postShort' );
            </script>
          </div>

          {{-- long text /editor --}}
          <div class="form-item">
            <label for="postLong">Long text</label>
            <textarea name="postLong" id="postLong" cols="30" rows="25">{{ old('postLong') ? old('postLong') : $post->long_text }}</textarea>
            <script>
              CKEDITOR.replace( 'postLong' );
            </script>
          </div>

          {{-- image --}}
          <div class="form-item">
            <label for="postImage">Upload new image</label>
            <p class="additional-info">Skip uploading image if you want to use already used one.</p>
            <input type="file" name="postImage" id="postImage">
          </div>

          {{-- image preview --}}
          <div class="form-item">
            <label for="postPrevImage">Old image preview</label>
            <img class="image-preview" src="{{ asset('storage/blog_images/'.$post->image) }}" alt="News Image">
            <input type="hidden" name="postPrevImage" value="{{ $post->image }}">
          </div>

          {{-- author --}}
          <div class="form-item">
            <label for="postAuthor">Author</label>
            <select class="{{ $errors->has('postAuthor') ? 'has-error' :'' }}" name="postAuthor" id="postAuthor">
              <option value="" disabled hidden>Choose author</option>
              @foreach($users as $user)
              @if (old('postAuthor'))
              <option value="{{ $user->id }}" {{
          old('postAuthor') == $user->id ? 'selected' :'' }}>
                {{ $user->firstname . ' ' . $user->lastname }}
              </option>
              @else
              <option value="{{ $user->id }}" {{ $post->user_id === $user->id ? 'selected' :'' }}>
                {{ $user->firstname . ' ' . $user->lastname }}
              </option>
              @endif
              @endforeach
            </select>
          </div>

          {{-- date --}}
          <div class="form-item">
            <label for="postDate">Date</label>
            <input class="{{ $errors->has('postDate') ? 'has-error' :'' }}" type="date" name="postDate" id="postDate"
              value="{{ old('postDate') ? old('postDate') : $post->date }}">
          </div>

          {{-- status --}}
          <div class="form-item">
            <label for="postStatus">Publish post?</label>
            @if (old('postStatus'))

            @if ((old('postStatus') == 'on') || (old('postStatus') == 1))
            <input class="inputStatus" name="postStatus" id="postStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="postStatus" id="postStatus" type="checkbox">
            @endif

            @else
            <input class="inputStatus" name="postStatus" id="postStatus" type="checkbox"
              {{ $post->status == 1 ? 'checked' : ''}}>
            @endif
          </div>

          {{-- id --}}
          <input hidden name="postId" type="number" value="{{ $post->id }}">

          {{-- hidden submit --}}
          <input type="submit" value="Add Post" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('editPostForm').submit();">Update
          Post</button>
      </div>

    </div>

  </div>

</div>

@endsection
