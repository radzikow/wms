@extends('layouts.app')

@section('content')

{{-- Contact Information --}}

{{-- Main Wrapper --}}
<div class="main-wrapper">

  {{-- Title --}}
  <div class="title-wrapper">
    <h1 class="title"><a href="{{ url('/dashboard/contact') }}">Contact Information</a></h1>
  </div>

  {{-- Main Wrapper --}}
  <div class="main-content">

    {{-- Title --}}
    <div class="content-title">
      <p>Contact Information</p>
    </div>

    {{-- Content --}}
    <div class="content">

      {{-- content form --}}
      <div class="content-forms">

          {{-- form --}}
          <form class="form" id="updateContactForm" action="/dashboard/contact" method="POST">
            @csrf
            @method('PUT')

            {{-- company name --}}
            <div class="form-item">
              <label for="companyName">Company name</label>
              <input type="text" name="companyName" id="companyName"
                value="{{ old('companyName') ? old('companyName') : $contactInfo['company_name'] }}">
            </div>

            {{-- nip --}}
            <div class="form-item">
              <label for="companyNip">NIP</label>
              <input type="text" name="companyNip" id="companyNip"
                value="{{ old('companyNip') ? old('companyNip') : $contactInfo['company_nip'] }}">
            </div>

            {{-- regon --}}
            <div class="form-item">
              <label for="companyRegon">REGON</label>
              <input type="text" name="companyRegon" id="companyRegon"
                value="{{ old('companyRegon') ? old('companyRegon') : $contactInfo['company_regon'] }}">
            </div>

            {{-- phone number --}}
            <div class="form-item">
              <label for="phoneNumber">Phone numbers</label>
              <input type="text" name="phoneNumber1" id="phoneNumber1"
                value="{{ old('phoneNumber1') ? old('phoneNumber1') : $contactInfo['company_number1'] }}">
              <input type="text" name="phoneNumber2" id="phoneNumber2"
                value="{{ old('phoneNumber2') ? old('phoneNumber2') : $contactInfo['company_number2'] }}">
            </div>

            {{-- e-mail address --}}
            <div class="form-item">
              <label for="emailAddress">E-mail addresses</label>
              <input type="text" name="emailAddress1" id="emailAddress1"
                value="{{ old('emailAddress1') ? old('emailAddress1') : $contactInfo['company_email1'] }}">
              <input type="text" name="emailAddress2" id="emailAddress2"
                value="{{ old('emailAddress2') ? old('emailAddress2') : $contactInfo['company_email2'] }}">
            </div>

            {{-- address --}}
            <div class="form-item">
              <label for="companyAddress">Address</label>
              <input type="text" name="companyAddress1" id="companyAddress1"
                value="{{ old('companyAddress1') ? old('companyAddress1') : $contactInfo['company_address1'] }}">
              <input type="text" name="companyAddress2" id="companyAddress2"
                value="{{ old('companyAddress2') ? old('companyAddress2') : $contactInfo['company_address2'] }}">
            </div>

            {{-- hours --}}
            <div class="form-item">
              <label for="companyHours">Opening hours</label>
              <input type="text" name="companyHours1" id="companyHours1"
                value="{{ old('companyHours1') ? old('companyHours1') : $contactInfo['company_hours1'] }}">
              <input type="text" name="companyHours2" id="companyHours2"
                value="{{ old('companyHours2') ? old('companyHours2') : $contactInfo['company_hours2'] }}">
            </div>

            {{-- linkedin --}}
            <div class="form-item">
              <label for="linkedin">Linkedin link</label>
              <input type="text" name="linkedin" id="linkedin"
                value="{{ old('linkedin') ? old('linkedin') : $socialLinks['linkedin'] }}">
            </div>

            {{-- facebook --}}
            <div class="form-item">
              <label for="facebook">Facebook link</label>
              <input type="text" name="facebook" id="facebook"
                value="{{ old('facebook') ? old('facebook') : $socialLinks['facebook'] }}">
            </div>

            {{-- twitter --}}
            <div class="form-item">
              <label for="twitter">Twitter link</label>
              <input type="text" name="twitter" id="twitter"
                value="{{ old('twitter') ? old('twitter') : $socialLinks['twitter'] }}">
            </div>

          </form>

        </div>

        {{-- content button --}}
        <div class="content-button">
          <button onclick="document.getElementById('updateContactForm').submit();"
            class="button button-success">Update</button>
        </div>

    </div>

  </div>

</div>

@endsection
