@extends('home::layouts.master')

@section('title', 'Aanmelden als nieuw lid')

@section('content')
  <div class="m-3">
    <div class="container-fluid">
      <form class="" action="{{ route('new_member.store') }}" method="POST">
        @csrf
        <h1 class="text-dark">Aanmelden als nieuw lid van T.R.M.C.</h1>

        <div class="row">
          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="name" class="font-weight-bold"><strong>Volledige naam</strong></label>
                <input type="text" class="form-control shadow" id="name" name="name" aria-describedby="fullname" placeholder="Voornaam achternaam" value="{{ old('name') }}" required>
                <!-- <small id="fullname" class="form-text text-muted"></small>-->
              </div>

              <div class="form-group">
                <label for="birthdate" class="font-weight-bold"><strong>Geboortedatum</strong></label>
                <input type="text" class="form-control shadow" id="birthdate" name="birthdate" placeholder="01-01-2024" value="{{ old('birthdate') }}" required>
              </div>
            </div>
          </div>

          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="address" class="font-weight-bold"><strong>Adres</strong></label>
                <input type="text" class="form-control shadow" id="address" name="address" placeholder="Straatnaam nummer" value="{{ old('address') }}" required>
              </div>

              <div class="form-group">
                <label for="postcode" class="font-weight-bold"><strong>Postcode</strong></label>
                <input type="text" class="form-control shadow" id="postcode" name="postcode" placeholder="1234AH (zonder spatie!)" value="{{ old('postcode') }}" required>
              </div>

              <div class="form-group">
                <label for="city" class="font-weight-bold"><strong>Woonplaats</strong></label>
                <input type="text" class="form-control shadow" id="city" name="city" placeholder="Woonplaats" value="{{ old('city') }}" required>
              </div>
            </div>
          </div>

          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="phone" class="font-weight-bold"><strong>Telefoon</strong></label>
                <input type="text" class="form-control shadow" id="phone" name="phone" placeholder="0612343455 (nummer zonder streepje!)" value="{{ old('phone') }}" required>
              </div>

              <div class="form-group">
                <label for="email" class="font-weight-bold"><strong>E-mail</strong></label>
                <input type="email" class="form-control shadow" id="email" name="email" placeholder="mail@provider.nl" value="{{ old('email') }}" required>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-2">
          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="rdw_number" class="font-weight-bold"><strong>RDW nummer</strong></label>
                <input type="text" class="form-control shadow" id="rdw_number" name="rdw_number" placeholder="Niet vereist" value="{{ old('rdw_number') }}">
              </div>

              <div class="form-group">
                <label for="knvvl"  class="font-weight-bold"><strong>KNVvl nummer</strong></label>
                <input type="text" class="form-control shadow" id="knvvl" name="knvvl" placeholder="Niet vereist" value="{{ old('knvvl') }}">
              </div>
            </div>
          </div>

          <div class="col-sm">
            <div class="pt-2 pb-2 ps-2 pe-2 mb-2 mt-2 w-25">
              <h4 class="font-weight-bold mb-0"><strong>Drone certificaten</strong></h4>
              <div class="form-check">
                <input class="form-check-input shadow" type="checkbox" value=1 id="droneA1Checkbox" name="droneA1Checkbox">
                <label class="form-check-label" for="droneA1Checkbox">
                  A1
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input shadow" type="checkbox" value=1 id="droneA2Checkbox" name="droneA2Checkbox">
                <label class="form-check-label" for="droneA2Checkbox">
                  A2
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input shadow" type="checkbox" value=1 id="droneA3Checkbox" name="droneA3Checkbox">
                <label class="form-check-label" for="droneA3Checkbox">
                  A3
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <h4 class="font-weight-bold mb-0"><strong>Brevetten</strong></h4>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value=1 id="PlaneCertCheckbox" name="PlaneCertCheckbox">
                <label class="form-check-label" for="PlaneCertCheckbox">
                  Motorvliegtuig
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input shadow" type="checkbox" value=1 id="HeliCertCheckbox" name="HeliCertCheckbox">
                <label class="form-check-label" for="HeliCertCheckbox">
                  Helicopter
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value=1 id="gliderCertCheckbox" name="gliderCertCheckbox">
                <label class="form-check-label" for="gliderCertCheckbox">
                  Zweefvliegtuig
                </label>
              </div>
            </div>
          </div>

          <div class="form-group mb-2">
            <label for="anti_bot" class="font-weight-bold"><strong>Anti bot (vereist)</strong></label>
            <input type="text" class="form-control shadow" id="anti_bot" name="anti_bot" placeholder="Wat is 2 + 2?" value="{{ old('anti_bot') }}" required>
          </div>
        </div>

        <x-buttons.send-home />
      </form>
    </div>
  </div>
@endsection
