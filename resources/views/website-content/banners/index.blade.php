@extends('layouts.app')

@section('content')

{{-- Banners --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('dashboard/banners') }}">Banners</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>All banners</p>
      <div class="title-buttons">
        <a class="title-button button-add" href="{{ url('/dashboard/banners/create') }}" class="action add-record"><img
            src="{{ asset('/svg/add.svg') }}" alt="Add"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content table --}}
      <div class="content-tables">

        {{-- table --}}
        <table>
          <thead>
            <tr class="banners-table-head">
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>Image</th>
              <th>@sortablelink('title')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($banners as $key => $banner)
            <tr>
              <td><img class="td-image" src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>

              <td><img class="table-image-preview" src="{{ Storage::disk('s3')->url($banner->image_s3_path) }}" alt="Banner Image"></td>

              <td>{{ $banner->title }}</td>
              <td><span
                  class="status {{ $banner->status == 1 ? 'published' : 'unpublished' }}">{{ $banner->status == 1 ? 'Published' : 'Unpublished' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/banners/{{ $banner->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}"
                    alt="Edit"></a>
                <form action="/dashboard/banners/{{$banner->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button id="" onclick="return confirm('Are you sure you want to delete this banner?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- pagination --}}
      <span class="pagination">{{ $banners->links() }}</span>

    </div>

  </div>

</div>

@endsection
