@extends('layouts.app')

@section('content')

{{-- Newsletter --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/newsletter') }}">Newsletter</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    <div class="content-title">
      <p>All registered subscribers</p>
      <div class="title-buttons">
        <a class="title-button button-delete" href=""><img src="{{ asset('/svg/delete2.svg') }}" alt="Delete"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- table --}}
      <div class="content-tables">

        <table>
          <thead class="newsletter-table-head">
            <tr>
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>@sortablelink('firstname')</th>
              <th>@sortablelink('lastname')</th>
              <th>@sortablelink('email')</th>
              <th>@sortablelink('phone')</th>
              <th>@sortablelink('created_at', 'Since')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($subscribers as $key => $subscriber)
            <tr>
              <td><img src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>
              <td>{{ $subscriber->firstname }}</td>
              <td>{{ $subscriber->lastname }}</td>
              <td>{{ $subscriber->email }}</td>
              <td>{{ $subscriber->phone }}</td>
              <td>{{ date('Y-m-d', strtotime($subscriber->created_at)) }}</td>
              <td class="options">
                <form action="/dashboard/newsletter/{{$subscriber->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure you want to delete this subscriber?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- Pagination --}}
      <span class="pagination">{{ $subscribers->links() }}</span>

    </div>

  </div>

</div>

@endsection
