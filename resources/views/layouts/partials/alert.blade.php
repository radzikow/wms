@if(Session::has('alert-message'))
<div id="alert" class="alert-wrapper {{ Session::get('alert-class') }}">

  <div class="alert-image">
    @if(Session::has('alert-class') && Session::get('alert-class') == 'alert-success')
    <img src="{{ asset('/svg/success.svg') }}" alt="Success">
    @elseif(Session::has('alert-class') && Session::get('alert-class') ==  'alert-warning')
    <img src="{{ asset('/svg/warning.svg') }}" alt="Warning">
    @elseif(Session::has('alert-class') && Session::get('alert-class') ==  'alert-danger')
    <img src="{{ asset('/svg/danger.svg') }}" alt="Danger">
    @else
    <img src="{{ asset('/svg/success.svg') }}" alt="Success">
    @endif
  </div>

  <div class="alert-text">
    <p>{{ Session::get('alert-message') }}</p>
  </div>

  <div class="alert-close">
    <img id="closeAlertBtn" src="{{ asset('/svg/close.svg') }}" alt="Close">
  </div>

</div>
@endif
