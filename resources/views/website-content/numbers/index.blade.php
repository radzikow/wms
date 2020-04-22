@extends('layouts.app')

@section('content')

{{-- Numbers --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/numbers') }}">Numbers</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Numbers</p>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content form --}}
      <div class="content-forms">

        {{-- form --}}
        <form class="form" id="updateNumberstForm" action="/dashboard/numbers" method="POST">
          @csrf
          @method('PUT')

          {{-- clients number --}}
          <div class="form-item">
            <label for="clientsNumber">Number of clients</label>
            <input type="text" name="clientsNumber" id="clientsNumber"
              value="{{ old('clientsNumber') ? old('clientsNumber') : $numbers['clients_no'] }}">
          </div>

          {{-- projects number --}}
          <div class="form-item">
            <label for="projectsNumber">Number of projects</label>
            <input type="text" name="projectsNumber" id="projectsNumber"
              value="{{ old('projectsNumber') ? old('projectsNumber') : $numbers['projects_no'] }}">
          </div>

          {{-- coffees number --}}
          <div class="form-item">
            <label for="coffeesNumber">Number of coffees</label>
            <input type="text" name="coffeesNumber" id="coffeesNumber"
              value="{{ old('coffeesNumber') ? old('coffeesNumber') : $numbers['coffees_no'] }}">
          </div>

        </form>

      </div>

      {{-- content button --}}
      <div class="content-button">
        <button onclick="document.getElementById('updateNumberstForm').submit();"
          class="button button-success">Update</button>
      </div>

    </div>

  </div>

</div>

@endsection
