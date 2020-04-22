@extends('layouts.app')

@section('content')

{{-- Add FAQ --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/faq') }}">FAQ</a> / <a href="{{ url('/dashboard/faq/create') }}">Add
        FAQ</a></h1>
  </div>

  {{-- Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Add FAQ</p>
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
        <form class="form" action="/dashboard/faq" method="POST" id="addFaqForm">
          @csrf

          {{-- question --}}
          <div class="form-item">
            <label for="faqQuestion">Question</label>
            <input class="{{ $errors->has('faqQuestion') ? 'has-error' :'' }}" type="text" name="faqQuestion"
              id="faqQuestion" value="{{ old('faqQuestion') }}">
          </div>

          {{-- answer --}}
          <div class="form-item">
            <label for="faqAnswer">Answer</label>
            <textarea class="{{ $errors->has('faqAnswer') ? 'has-error' :'' }}" name="faqAnswer" id="faqAnswer"
              cols="30" rows="5">{{ old('faqAnswer') }}</textarea>
            <script>
              CKEDITOR.replace( 'faqAnswer' );
            </script>
          </div>

          {{-- user id (hidden) --}}
          <input type="text" id="newsUserId" name="faqUserId" value="{{ Auth::user()->id }}" hidden>

          {{-- status --}}
          <div class="form-item">
            <label for="faqStatus">Publish faq?</label>
            @if (old('newsStatus') === 'on')
            <input name="faqStatus" id="faqStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="faqStatus" id="faqStatus" type="checkbox">
            @endif
          </div>

          {{-- submit (hidden) --}}
          <input type="submit" value="Add Faq" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('addFaqForm').submit();">Add
          Faq</button>
      </div>

    </div>

  </div>

</div>

@endsection
