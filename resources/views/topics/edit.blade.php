@extends('layouts.app')

@section('content')

{{-- Edit Topic --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/topics') }}">Blog Topics</a></h1> / <h1 class="title"><a href="{{ url('/dashboard/topics/' . $topic->id) }}">Edit Topic</a></h1>
  </div>

  {{-- Content --}}
  <div class=" main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Edit topic</p>
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
        <form id="editTopicForm" class="form" method="POST" action="/dashboard/topics">
          @method('PUT')
          @csrf

          {{-- name --}}
          <div class="form-item">
            <label for="topicName">Name</label>
            @if (old('topicName'))
            <input class="{{ $errors->has('topicName') ? 'has-error' :'' }}" type="text" name="topicName" id="topicName"
              value="{{ old('topicName') }}">
            @else
            <input class="{{ $errors->has('topicName') ? 'has-error' :'' }}" type="text" name="topicName" id="topicName"
              value="{{ $topic->name }}">
            @endif
          </div>

          {{-- description --}}
          <div class="form-item">
            <label for="topicDescription">Description</label>
            @if(old('topicDescription'))
            <textarea class="{{ $errors->has('postAuthor') ? 'has-error' :'' }}" name="topicDescription"
              id="topicDescription" cols="30" rows="3">{{ old('topicDescription') }}</textarea>
            @else
            <textarea class="{{ $errors->has('postAuthor') ? 'has-error' :'' }}" name="topicDescription"
              id="topicDescription" cols="30" rows="3">{{ $topic->description }}</textarea>
            @endif
          </div>

          {{-- status --}}
          <div class="form-item">
            <label for="topicStatus">Active?</label>
            @if (old('topicStatus'))

            @if ((old('topicStatus') == 'on') || (old('topicStatus') == 1))
            <input class="inputStatus" name="topicStatus" id="topicStatus" type="checkbox" checked>
            @else
            <input class="inputStatus" name="topicStatus" id="topicStatus" type="checkbox">
            @endif

            @else
            <input class="inputStatus" name="topicStatus" id="topicStatus" type="checkbox"
              {{ $topic->status == 1 ? 'checked' : ''}}>
            @endif
          </div>

          {{-- id --}}
          <input hidden name="topicId" type="number" value="{{ $topic->id }}">

          {{-- hidden submit --}}
          <input type="submit" value="Add Topic" hidden>

        </form>

      </div>

      {{-- Button --}}
      <div class="content-button">
        <button class="button button-success" onclick="document.getElementById('editTopicForm').submit();">Update
          Topic</button>
      </div>

    </div>

  </div>

</div>

@endsection
