@extends('layouts.app')

@section('content')

{{-- FAQ --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/faq') }}">FAQ</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>All frequently asked questions</p>
      <div class="title-buttons">
        <a href="{{ url('/dashboard/faq/create') }}" class="title-button button-add"><img
            src="{{ asset('/svg/add.svg') }}" alt="Add"></a>
      </div>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content table --}}
      <div class="content-tables">

        <table>
          <thead class="faq-table-head">
            <tr>
              <th><img src="{{ url('/svg/square.svg') }}" alt="Select"></th>
              <th>#</th>
              <th>@sortablelink('question')</th>
              <th>@sortablelink('answer')</th>
              <th>@sortablelink('status')</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($faqs as $key => $faq)
            <tr>
              <td><img src="{{ url('/svg/square.svg') }}" alt="Select"></td>
              <td>{{ $key + 1 }}</td>
              <td>{{ $faq->question }}</td>
              <td>{{ substr(strip_tags(html_entity_decode($faq->answer)), 0, 140) . '...' }}</td>
              <td><span
                  class="status {{ $faq->status == 1 ? 'active' : 'inactive' }}">{{ $faq->status == 1 ? 'Active' : 'Inactive' }}</span>
              </td>
              <td class="options">
                <a href="/dashboard/faq/{{ $faq->id }}"><img src="{{ url('/svg/edit-yellow.svg') }}" alt="Edit"></a>
                <form action="/dashboard/faq/{{ $faq->id }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Are you sure you want to delete this faq?')"><img
                      src="{{ url('/svg/delete-red.svg') }}" alt="Delete"></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

      {{-- Pagination --}}
      <span class="pagination">{{ $faqs->links() }}</span>

    </div>

  </div>

</div>

@endsection
