<div id="confirm" class="confirm-wrapper confirm-warning">

  <div class="confirm-image">
    @if(Session::has('alert-class') === 'success')
    <img src="{{ asset('/svg/success.svg') }}" alt="Success">
    @elseif(Session::has('alert-class') === 'warning')
    <img src="{{ asset('/svg/warning.svg') }}" alt="Warning">
    @elseif(Session::has('alert-class') === 'danger')
    <img src="{{ asset('/svg/danger.svg') }}" alt="Danger">
    @else
    <img src="{{ asset('/svg/success.svg') }}" alt="Success">
    @endif
  </div>

  <div class="confirm-text">
    <p>{{ Session::get('confirm-message') }}</p>
  </div>

  <div class="alert-close">
    <img id="closeAlertBtn" src="{{ asset('/svg/close.svg') }}" alt="Close">
  </div>

</div>
