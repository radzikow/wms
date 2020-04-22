@extends('layouts.app')

@section('content')

{{-- Activity --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/activity') }}">Activity</a></h1>
  </div>

  {{-- Main Content --}}
  <div class="main-content">

    <div class="content-title">
      <p>All activity logs</p>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content table --}}
      <div class="content-tables">

        {{-- table --}}
        <table>
          <thead class="activity-table-head">
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>User ID</th>
              <th>Event</th>
              <th>Model</th>
              <th>Old Values</th>
              <th>New Values</th>
              <th>URL</th>
              <th>IP</th>
            </tr>
          </thead>
          <tbody>

            @foreach($audits as $key => $audit)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $audit->created_at }}</td>
              <td>{{ $audit->user_id }}</td>
              <td>{{ $audit->event }}</td>
              <td>{{ $audit->auditable_type }}</td>
              <td>
                @if ($audit->old_values)
                @foreach(json_decode($audit->old_values) as $key => $value)
                <span>{{ substr(strip_tags(html_entity_decode($key)), 0, 140) . ' : ' . substr(strip_tags(html_entity_decode($value)), 0, 140) . ', ' }}</span>
                @endforeach
                @else
                no data
                @endif

              </td>
              <td>
                @if ($audit->new_values)
                @foreach(json_decode($audit->new_values) as $key => $value)
                <span>{{ substr(strip_tags(html_entity_decode($key)), 0, 140) . ' : ' . substr(strip_tags(html_entity_decode($value)), 0, 140) . ', ' }}</span>
                @endforeach
                @else
                no data
                @endif
              </td>
              <td>{{ $audit->url }}</td>
              <td>{{ $audit->ip_address }}</td>
            </tr>
            @endforeach

          </tbody>
        </table>

      </div>

      {{-- pagination --}}
      <span class="pagination">{{ $audits->links() }}</span>

    </div>

  </div>

</div>

@endsection
