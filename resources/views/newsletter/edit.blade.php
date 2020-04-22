@extends('layouts.app')

@section('content')

{{-- Edit Subscriber --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/newsletter') }}">Newsletter</a> / <a
        href="{{ url('/dashboard/newsletter/' . $subscriber->id) }}">Edit
        Subscriber</a>
    </h1>

  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Edit subscriber</p>
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

        {{-- Form --}}
        <form class="form" action="/dashboard/newsletter" method="POST" id="updateNewsletterForm">
          @csrf
          @method('PUT')

          {{-- firstname --}}
          <div class="form-item">
            <label for="userFirstname">Firstname</label>
            <input type="text" name="userFirstname" id="userFirstname">
          </div>

          {{-- lastname --}}
          <div class="form-item">
            <label for="userLastname">Lastname</label>
            <input type="text" name="userLastname" id="userLastname">
          </div>

          {{-- email --}}
          <div class="form-item">
            <label for="userEmail">E-mail</label>
            <input type="text" name="userEmail" id="userEmail">
          </div>

          {{-- status (default: active) --}}
          <input hidden type="checkbox" value="Status" checked>

          {{-- submit (hidden) --}}
          <input hidden type="submit" value="Edit Subscriber">

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('updateSubscriberForm').submit();">Update
          Subscriber</button>
      </div>

    </div>

  </div>

</div>

@endsection
