@extends('layouts.app')

@section('content')

{{-- Add Project --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/projects') }}">Projects</a> / <a
        href="{{ url('/dashboard/projects/create') }}">Add project</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Add project</p>
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
        <form class="form" action="/dashboard/projects" method="POST" id="addProjectForm" enctype="multipart/form-data">
          @csrf

          {{-- title --}}
          <div class="form-item">
            <label for="projectTitle">Title</label>
            <input class="{{ $errors->has('projectTitle') ? 'has-error' :'' }}" type="text" name="projectTitle"
              id="projectTitle" value="{{ old('projectTitle') }}">
          </div>

          {{-- company --}}
          <div class="form-item">
            <label for="projectCompany">Company</label>
            <input class="{{ $errors->has('projectCompany') ? 'has-error' :'' }}" type="text" name="projectCompany"
              id="projectCompany" value="{{ old('projectCompany') }}">
          </div>

          {{-- category --}}
          <div class="form-item">
            <label for="projectCategory">Category</label>
            <input class="{{ $errors->has('projectCategory') ? 'has-error' :'' }}" type="text" name="projectCategory"
              id="projectCategory" value="{{ old('projectCategory') }}">
          </div>

          {{-- description 1 --}}
          <div class="form-item">
            <label for="projectDescription1">Description 1</label>
            <input class="{{ $errors->has('projectDescription1') ? 'has-error' :'' }}" type="text"
              name="projectDescription1" id="projectDescription1" value="{{ old('projectDescription1') }}">
          </div>

          {{-- description 2 --}}
          <div class="form-item">
            <label for="projectDescription2">Description 2</label>
            <input class="{{ $errors->has('projectDescription2') ? 'has-error' :'' }}" type="text"
              name="projectDescription2" id="projectDescription2" value="{{ old('projectDescription2') }}">
          </div>

          {{-- btn link --}}
          <div class="form-item">
            <label for="projectBtnLink">Button Link</label>
            <input class="{{ $errors->has('projectBtnLink') ? 'has-error' :'' }}" type="text" name="projectBtnLink"
              id="projectBtnLink" value="{{ old('projectBtnLink') }}">
          </div>

          {{-- btn text --}}
          <div class="form-item">
            <label for="projectBtnText">Button Text</label>
            <input class="{{ $errors->has('projectBtnText') ? 'has-error' :'' }}" type="text" name="projectBtnText"
              id="projectBtnText" value="{{ old('projectBtnText') }}">
          </div>

          {{-- list 1 --}}
          <div class="form-item">
            <label for="projectList1">List 1</label>
            <input class="{{ $errors->has('projectList1') ? 'has-error' :'' }}" type="text" name="projectList1"
              id="projectList1" value="{{ old('projectList1') }}">
          </div>

          {{-- list 2 --}}
          <div class="form-item">
            <label for="projectList2">List 2</label>
            <input class="{{ $errors->has('projectList2') ? 'has-error' :'' }}" type="text" name="projectList2"
              id="projectList2" value="{{ old('projectList2') }}">
          </div>

          {{-- image --}}
          <div class="form-item">
            <label for="projectImage">Upload image</label>
            <input class="{{ $errors->has('projectImage') ? 'has-error' :'' }}" type="file" name="projectImage"
              id="projectImage">
          </div>

          {{-- status --}}
          <div class="form-item">
            <label for="projectStatus">Publish project?</label>
            @if (old('projectStatus') === 'on')
            <input name="projectStatus" id="projectStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="projectStatus" id="projectStatus" type="checkbox">
            @endif
          </div>

          {{-- submit (hidden) --}}
          <input type="submit" value="Add Project" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('addProjectForm').submit();">Add
          Project</button>
      </div>

    </div>

  </div>

</div>

@endsection
