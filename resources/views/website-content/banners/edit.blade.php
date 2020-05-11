@extends('layouts.app')

@section('content')

{{-- Edit Banner --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/banners') }}">Banners</a> / <a
        href="{{ url('/dashboard/banners/' . $banner->id) }}">Edit banner</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Edit banner</p>
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
        <form class="form" action="/dashboard/banners" method="POST" id="updateBannerForm"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- title --}}
          <div class="form-item">
            <label for="bannerTitle">Title</label>
            <input class="{{ $errors->has('bannerTitle') ? 'has-error' :'' }}" type="text" name="bannerTitle"
              id="bannerTitle" value="{{ old('bannerTitle') ? old('bannerTitle') : $banner->title }}">
          </div>

          {{-- text 1 --}}
          <div class="form-item">
            <label for="bannerText1">Text 1</label>
            <input class="{{ $errors->has('bannerText1') ? 'has-error' :'' }}" type="text" name="bannerText1"
              id="bannerText1" value="{{ old('bannerText1') ? old('bannerText1') : $banner->text_1 }}">
          </div>

          {{-- text 2 --}}
          <div class="form-item">
            <label for="bannerText2">Text 2</label>
            <input class="{{ $errors->has('bannerText2') ? 'has-error' :'' }}" type="text" name="bannerText2"
              id="bannerText2" value="{{ old('bannerText2') ? old('bannerText2') : $banner->text_2 }}">
          </div>

          {{-- btn link --}}
          <div class="form-item">
            <label for="bannerBtnLink">Button Link</label>
            <input class="{{ $errors->has('bannerBtnLink') ? 'has-error' :'' }}" type="text" name="bannerBtnLink"
              id="bannerBtnLink" value="{{ old('bannerBtnLink') ? old('bannerBtnLink') : $banner->btn_link }}">
          </div>

          {{-- btn text --}}
          <div class="form-item">
            <label for="bannerBtnText">Button Text</label>
            <input class="{{ $errors->has('bannerBtnText') ? 'has-error' :'' }}" type="text" name="bannerBtnText"
              id="bannerBtnText" value="{{ old('bannerBtnText') ? old('bannerBtnText') : $banner->btn_text }}">
          </div>

          {{-- image --}}
          <div class="form-item">
            <label for="bannerImage">Upload image (max 1MB)</label>
            <input class="{{ $errors->has('bannerImage') ? 'has-error' :'' }}" type="file" name="bannerImage"
              id="editedBannerImage">
          </div>

          <div class="form-item">
            <input id="currentEditedBannerImage" type="hidden" name="currentBannerImage" value="{{ $banner->image_s3_path }}">
          </div>

          {{-- image preview --}}
          <div class="form-item">
            <img id="editedBannerImagePreview" class="image-preview" src="{{ Storage::disk('s3')->url($banner->image_s3_path) }}" alt="Banner Image">
          </div>

          {{-- status --}}
          <div class="form-item">
            <label for="bannerStatus">Publish banner?</label>
            @if (old('bannerStatus'))

            @if ((old('bannerStatus') == 'on') || (old('bannerStatus') == 1))
            <input class="inputStatus" name="bannerStatus" id="bannerStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="bannerStatus" id="bannerStatus" type="checkbox">
            @endif

            @else
            <input class="inputStatus" name="bannerStatus" id="bannerStatus" type="checkbox"
              {{ $banner->status == 1 ? 'checked' : ''}}>
            @endif
          </div>

          {{-- id --}}
          <input hidden name="bannerId" type="number" value="{{ $banner->id }}">

          {{-- submit (hidden) --}}
          <input type="submit" value="Update Banner" hidden>

        </form>

      </div>

    </div>
    {{-- Button --}}
    <div class="content-button">
      <button class="button button-success" onclick="document.getElementById('updateBannerForm').submit();">Update
        Banner</button>
    </div>

  </div>

</div>

@endsection
