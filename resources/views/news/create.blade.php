@extends('layouts.app')

@section('content')

{{-- Add News --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/news') }}">News</a> / <a
        href="{{ url('/dashboard/news/create') }}">Add news</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Add news</p>
    </div>

    {{-- Errors --}}
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

      {{-- form --}}
      <div class="content-forms">

        {{-- form --}}
        <form class="form" action="/dashboard/news" method="POST" id="addNewsForm" enctype="multipart/form-data">
          @csrf

          {{-- date --}}
          <div class="form-item">
            <label for="newsDate">Date</label>
            <input class="{{ $errors->has('newsDate') ? 'has-error' :'' }}" type="date" name="newsDate" id="newsDate"
              value="{{ old('newsDate') }}">
          </div>

          {{-- title --}}
          <div class="form-item">
            <label for="newsTitle">Title</label>
            <input class="{{ $errors->has('newsTitle') ? 'has-error' :'' }}" type="text" name="newsTitle" id="newsTitle"
              value="{{ old('newsTitle') }}">
          </div>

          {{-- content --}}
          <div class="form-item">
            <label for="postShort">Content</label>
            <textarea class="{{ $errors->has('newsContent') ? 'has-error' :'' }}" name="newsContent" id="newsContent"
              cols="30" rows="5">{{ old('newsContent') }}</textarea>
            <script>
              CKEDITOR.replace( 'newsContent' );
            </script>
          </div>

          {{-- image --}}
          <div class="form-item">
            <label for="newsImage">Upload image</label>
            <input class="{{ $errors->has('newsImage') ? 'has-error' :'' }}" type="file" name="newsImage"
              id="newsImage">
          </div>

          {{-- user id (hidden) --}}
          <input type="text" id="newsUserId" name="newsUserId" value="{{ Auth::user()->id }}" hidden>

          {{-- status --}}
          <div class="form-item">
            <label for="newsStatus">Publish news?</label>
            @if (old('newsStatus') === 'on')
            <input class="inputStatus" name="newsStatus" id="newsStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" class="inputStatus" name="newsStatus" id="newsStatus" type="checkbox">
            @endif
          </div>

          {{-- submit (hidden) --}}
          <input type="submit" value="Add News" hidden>

        </form>

      </div>

    </div>
    {{-- Button --}}
    <div class="content-button">
      <button class="button button-success" onclick="document.getElementById('addNewsForm').submit();">Add
        News</button>
    </div>

  </div>

</div>

@endsection
