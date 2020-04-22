@extends('layouts.app')

@section('content')

{{-- Add Topic --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/topics') }}">Blog Topics</a> / <a
        href="{{ url('/dashboard/topics/create') }}">Add
        Topic</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Add new topic</p>
    </div>

    {{-- errors --}}
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
        <form id="addTopicForm" class="form" method="POST" action="/dashboard/topics">
          @csrf

          {{-- name --}}
          <div class="form-item">
            <label for="topicName">Name</label>
            <input class="{{ $errors->has('postAuthor') ? 'has-error' :'' }}" type="text" name="topicName"
              id="topicName">
          </div>

          {{-- description --}}
          <div class="form-item">
            <label for="topicDescription">Description</label>
            <textarea class="{{ $errors->has('postAuthor') ? 'has-error' :'' }}" name="topicDescription"
              id="topicDescription" cols="30" rows="3"></textarea>
          </div>

          {{-- status (default: active) --}}
          <div class="form-item">
            <label for="topicStatus">Active?</label>
            @if ((old('topicStatus') === 'on') || (old('topicStatus') === 1))
            <input class="inputStatus" name="topicStatus" id="topicStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="topicStatus" id="topicStatus" type="checkbox">
            @endif
          </div>

          {{-- hidden submit --}}
          <input type="submit" value="Add Topic" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('addTopicForm').submit();">Add
          Topic</button>
      </div>

    </div>

  </div>

</div>

@endsection
