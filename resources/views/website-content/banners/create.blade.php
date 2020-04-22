@extends('layouts.app')

@section('content')

{{-- Add Banner --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/banners') }}">Banners</a> / <a
        href="{{ url('/dashboard/banners/create') }}">Add banner</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Add banner</p>
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

      <div class="content-forms">

        {{-- form --}}
        <form class="form" action="/dashboard/banners" method="POST" id="addBannerForm" enctype="multipart/form-data">
          @csrf

          {{-- title --}}
          <div class="form-item">
            <label for="bannerTitle">Title</label>
            <input class="{{ $errors->has('bannerTitle') ? 'has-error' :'' }}" type="text" name="bannerTitle"
              id="bannerTitle" value="{{ old('bannerTitle') }}">
          </div>

          {{-- text 1 --}}
          <div class="form-item">
            <label for="bannerText1">Text 1</label>
            <input class="{{ $errors->has('bannerText1') ? 'has-error' :'' }}" type="text" name="bannerText1"
              id="bannerText1" value="{{ old('bannerText1') }}">
          </div>

          {{-- text 2 --}}
          <div class="form-item">
            <label for="bannerText2">Text 2</label>
            <input class="{{ $errors->has('bannerText2') ? 'has-error' :'' }}" type="text" name="bannerText2"
              id="bannerText2" value="{{ old('bannerText2') }}">
          </div>

          {{-- btn link --}}
          <div class="form-item">
            <label for="bannerBtnLink">Button Link</label>
            <input class="{{ $errors->has('bannerBtnLink') ? 'has-error' :'' }}" type="text" name="bannerBtnLink"
              id="bannerBtnLink" value="{{ old('bannerBtnLink') }}">
          </div>

          {{-- btn text --}}
          <div class="form-item">
            <label for="bannerBtnText">Button Text</label>
            <input class="{{ $errors->has('bannerBtnText') ? 'has-error' :'' }}" type="text" name="bannerBtnText"
              id="bannerBtnText" value="{{ old('bannerBtnText') }}">
          </div>

          {{-- image --}}
          <div class="form-item">
            <label for="bannerImage">Upload image</label>
            <input class="{{ $errors->has('bannerImage') ? 'has-error' :'' }}" type="file" name="bannerImage"
              id="bannerImage">
          </div>

          {{-- status --}}
          <div class="form-item">
            <label for="bannerStatus">Publish banner?</label>
            @if (old('bannerStatus') === 'on')
            <input name="bannerStatus" id="bannerStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="bannerStatus" id="bannerStatus" type="checkbox">
            @endif
          </div>

          {{-- submit (hidden) --}}
          <input type="submit" value="Add Banner" hidden>

        </form>

      </div>

    </div>
    {{-- Button --}}
    <div class="content-button">
      <button class="button button-success" onclick="document.getElementById('addBannerForm').submit();">Add
        Banner</button>
    </div>

  </div>

</div>

@endsection
