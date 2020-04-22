@extends('layouts.app')

@section('content')

{{-- Privacy & Cookies Section --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/cookies') }}">Privacy & Cookies</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Privacy & Cookies Policy</p>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content forms --}}
      <div class="content-forms">

        {{-- form --}}
        <form class="form" id="updatePolicyForm" action="/dashboard/policy" method="POST">
          @csrf
          @method('PUT')

          <textarea name="policyContent" id="policyContent" cols="30" rows="10">
            {{-- policy text --}}
            {{ $policy }}
            </textarea>
          <script>
            CKEDITOR.replace('policyContent');
          </script>

          <input type="submit" value="Update Policy" hidden>

        </form>

      </div>

      {{-- content button --}}
      <div class="content-button">
        <button onclick="document.getElementById('updatePolicyForm').submit();" class="button button-success">Update
          Policy</button>
      </div>

    </div>

  </div>

</div>

@endsection
