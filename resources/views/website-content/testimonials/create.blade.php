@extends('layouts.app')

@section('content')

{{-- Add Testimonial --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/testimonials') }}">Testimonials</a> / <a
        href="{{ url('/dashboard/testimonials/create') }}">Add testimonial</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Add testimonial</p>
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
        <form class="form" action="/dashboard/testimonials" method="POST" id="addTestimonialForm"
          enctype="multipart/form-data">
          @csrf

          {{-- name --}}
          <div class="form-item">
            <label for="testimonialName">Name</label>
            <input class="{{ $errors->has('testimonialName') ? 'has-error' :'' }}" type="text" name="testimonialName"
              id="testimonialName" value="{{ old('testimonialName') }}">
          </div>

          {{-- company --}}
          <div class="form-item">
            <label for="testimonialCompany">Company</label>
            <input class="{{ $errors->has('testimonialCompany') ? 'has-error' :'' }}" type="text"
              name="testimonialCompany" id="testimonialCompany" value="{{ old('testimonialCompany') }}">
          </div>

          {{-- text --}}
          <div class="form-item">
            <label for="testimonialText">Text</label>
            <textarea class="{{ $errors->has('testimonialText') ? 'has-error' :'' }}" name="testimonialText"
              id="testimonialText" cols="30" rows="5">{{ old('testimonialText') }}</textarea>
            <script>
              CKEDITOR.replace( 'testimonialText' );
            </script>
          </div>

          {{-- stars --}}
          <div class="form-item">
            <label for="testimonialStars">Stars</label>
            <input class="{{ $errors->has('testimonialStars') ? 'has-error' :'' }}" type="text" name="testimonialStars"
              id="testimonialStars" value="5">
          </div>

          {{-- image --}}
          <div class="form-item">
            <label for="testimonialImage">Upload image</label>
            <input class="{{ $errors->has('testimonialImage') ? 'has-error' :'' }}" type="file" name="testimonialImage"
              id="testimonialImage">
          </div>

          {{-- date --}}
          <div class="form-item form-date">
            <label for="testimonialDate">Date</label>
            <input class="{{ $errors->has('testimonialDate') ? 'has-error' :'' }}" type="date" name="testimonialDate"
              id="testimonialDate" value="{{ old('testimonialDate') }}">
          </div>

          {{-- status --}}
          <div class="form-item">
            <label for="testimonialStatus">Publish testimonial?</label>
            @if (old('testimonialStatus') === 'on')
            <input name="testimonialStatus" id="testimonialStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="testimonialStatus" id="testimonialStatus" type="checkbox">
            @endif
          </div>

          {{-- submit (hidden) --}}
          <input type="submit" value="Add Testimonial" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('addTestimonialForm').submit();">Add
          Testimonial</button>
      </div>

    </div>

  </div>

</div>

@endsection
