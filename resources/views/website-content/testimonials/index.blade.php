@extends('layouts.app')

@section('content')

{{-- Testimonials --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('dashboard/testimonials') }}">Testimonials</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>All testimonials</p>
      <div class="title-buttons">
        <a class="title-button button-add" href="{{ url('/dashboard/testimonials/create') }}"
          class="action add-record"><img src="{{ asset('/svg/add.svg') }}" alt="Add"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content table --}}
      <div class="content-tables">

        {{-- table --}}
        <table>
          <thead>
            <tr class="testimonials-table-head">
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>@sortablelink('date')</th>
              <th>@sortablelink('name')</th>
              <th>@sortablelink('company')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($testimonials as $key => $testimonial)
            <tr>
              <td><img class="td-image" src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>
              <td>{{ $testimonial->date }}</td>
              <td>{{ $testimonial->name }}</td>
              <td>{{ $testimonial->company }}</td>
              <td><span
                  class="status {{ $testimonial->status === 1 ? 'published' : 'unpublished' }}">{{ $testimonial->status === 1 ? 'Published' : 'Unpublished' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/testimonials/{{ $testimonial->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}"
                    alt="Edit"></a>
                <form action="/dashboard/testimonials/{{$testimonial->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button id="" onclick="return confirm('Are you sure you want to delete this testimonial?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- pagination --}}
      <span class="pagination">{{ $testimonials->links() }}</span>

    </div>

  </div>

</div>

@endsection
