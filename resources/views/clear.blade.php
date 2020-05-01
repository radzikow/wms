<div>
  <p><a href="{{ url('/clear-cache') }}">Clear cache facade value</a></p>
  <p><a href="{{ url('/route-clear') }}">Clear route cache</a></p>
  <p><a href="{{ url('/view-clear') }}">Clear view cache</a></p>
  <p><a href="{{ url('/config-cache') }}">Clear config cache</a></p>
</div>

@if(Session::has('clear-message'))
<div>
  <p>{{ Session::get('clear-message') }}</p>
</div>
@endif
