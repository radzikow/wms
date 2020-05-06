<div>
  <p><a href="{{ url('/clear-cache') }}">Clear cache facade value</a></p>
  <p><a href="{{ url('/clear-route') }}">Clear route cache</a></p>
  <p><a href="{{ url('/clear-view') }}">Clear view cache</a></p>
  <p><a href="{{ url('/clear-config') }}">Clear config cache</a></p>
</div>

@if(Session::has('clear-message'))
<div>
  <p>{{ Session::get('clear-message') }}</p>
</div>
@endif
