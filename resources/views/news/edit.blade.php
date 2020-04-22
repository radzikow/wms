@extends('layouts.app')

@section('content')

{{-- Edit News --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/news') }}">News</a> / <a
        href="{{ url('/dashboard/news/' . $oneNews->id) }}">Edit news</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Edit news</p>
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

      {{-- content form --}}
      <div class="content-forms">

        {{-- form --}}
        <form class="form" action="/dashboard/news" method="POST" id="updateNewsForm" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- date --}}
          <div class="form-item">
            <label for="newsDate">Date</label>
            <input class="{{ $errors->has('newsDate') ? 'has-error' :'' }}" type="date" name="newsDate" id="newsDate"
              value="{{ old('newsDate') ? old('newsDate') : $oneNews->date }}">
          </div>

          {{-- title --}}
          <div class="form-item">
            <label for="newsTitle">Title</label>
            <input class="{{ $errors->has('newsTitle') ? 'has-error' :'' }}" type="text" name="newsTitle" id="newsTitle"
              value="{{ old('newsTitle') ? old('newsTitle') : $oneNews->title }}">
          </div>

          {{-- content --}}
          <div class="form-item">
            <label for="postShort">Content</label>
            <textarea class="{{ $errors->has('newsContent') ? 'has-error' :'' }}" name="newsContent" id="newsContent"
              cols="30" rows="5">{{ old('newsContent') ? old('newsContent') : $oneNews->content }}</textarea>
            <script>
              CKEDITOR.replace( 'newsContent' );
            </script>
          </div>

          {{-- image --}}
          <div class="form-item">
            <label for="newsImage">Upload new image</label>
            <p class="additional-info">Skip uploading image if you want to use already used one.</p>
            <input class="{{ $errors->has('newsImage') ? 'has-error' :'' }}" type="file" name="newsImage"
              id="newsImage">
          </div>

          {{-- old image preview --}}
          <div class="form-item">
            <label for="newsPrevImage">Old image preview</label>
            <img class="image-preview" src="{{ asset('storage/news_images/'.$oneNews->image) }}" alt="News Image">
            <input type="hidden" name="newsPrevImage" value="{{ $oneNews->image }}">
          </div>

          {{-- user id (hidden) --}}
          <input type="text" id="newsUserId" name="newsUserId" value="{{ Auth::user()->id }}" hidden>

          {{-- status --}}
          <div class="form-item">
            <label for="newsStatus">Publish news?</label>
            @if (old('newsStatus'))

            @if ((old('newsStatus') == 'on') || (old('newsStatus') == 1))
            <input class="inputStatus" name="newsStatus" id="newsStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="newsStatus" id="newsStatus" type="checkbox">
            @endif

            @else
            <input class="inputStatus" name="newsStatus" id="newsStatus" type="checkbox"
              {{ $oneNews->status == 1 ? 'checked' : ''}}>
            @endif
          </div>

          {{-- id --}}
          <input hidden name="newsId" type="number" value="{{ $oneNews->id }}">

          {{-- submit (hidden) --}}
          <input type="submit" value="Add News" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('updateNewsForm').submit();">Update
          News</button>
      </div>

    </div>

  </div>

</div>

@endsection
