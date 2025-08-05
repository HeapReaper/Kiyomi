@extends('panel::layouts.master')

@section('title', 'Lid toevoegen')

@section('content')
  <div class="m-3">
    <div class="container-fluid">
      <form class="col-lg-6 offset-lg-3 pt-4 pb-4" action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="row bg-dark rounded bg-opacity-25 shadow-lg">
          <h2 class="text-white font-weight-bold">Lid toevoegen</h2>

          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="name" class="text-white font-weight-bold"><strong>Volledige naam</strong></label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="fullname" placeholder="Voornaam achternaam" value="{{ old('name') }}" required>
                <!-- <small id="fullname" class="form-text text-muted"></small>-->
              </div>

              <div class="form-group">
                <label for="birthdate"  class="text-white font-weight-bold"><strong>Geboortedatum</strong></label>
                <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="01-01-2024" value="{{ old('birthdate') }}" required>
              </div>
            </div>
          </div>

          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="address"  class="text-white font-weight-bold"><strong>Adres</strong></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Straatnaam nummer" value="{{ old('address') }}" required>
              </div>

              <div class="form-group">
                <label for="postcode"  class="text-white font-weight-bold"><strong>Postcode</strong></label>
                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="1234AH (zonder spatie!)" value="{{ old('postcode') }}" required>
              </div>

              <div class="form-group">
                <label for="city"  class="text-white font-weight-bold"><strong>Woonplaats</strong></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Woonplaats" value="{{ old('city') }}" required>
              </div>
            </div>
          </div>

          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="phone"  class="text-white font-weight-bold"><strong>Telefoon</strong></label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="0612343455 (nummer zonder streepje!)" value="{{ old('phone') }}" required>
              </div>

              <div class="form-group">
                <label for="email" class="text-white font-weight-bold"><strong>E-mail</strong></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="mail@provider.nl" value="{{ old('email') }}" required>
              </div>
            </div>
          </div>
        </div>

        <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2">
          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="rdw_number"  class="text-white font-weight-bold"><strong>RDW nummer</strong></label>
                <input type="text" class="form-control" id="rdw_number" name="rdw_number" placeholder="A34hjhdwqjkwqa" value="{{ old('rdw_number') }}">
              </div>

              <div class="form-group">
                <label for="knvvl"  class="text-white font-weight-bold"><strong>KNVvl nummer</strong></label>
                <input type="text" class="form-control" id="knvvl" name="knvvl" placeholder="1234567" value="{{ old('knvvl') }}">
              </div>
            </div>
          </div>

          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="instructor" class="text-white font-weight-bold"><strong>Keurmeester/Instructeur</strong></label>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="plane" id="1" name="instructor[]">
                  <label class="form-check-label text-white" for="junior_member">
                    Vliegtuig
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="glider_plane" id="2" name="instructor[]">
                  <label class="form-check-label text-white" for="member">
                    Zweefvliegtuig
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="helicopter" id="3" name="instructor[]">
                  <label class="form-check-label text-white" for="helicopter">
                    Helikopter
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="form-group">
                <label for="role" class="text-white font-weight-bold"><strong>Rol</strong></label>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="junior_member" id="junior_member" name="roles[]">
                  <label class="form-check-label text-white" for="junior_member">
                    Junior lid
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="aspirant_member" id="aspirant_member" name="roles[]">
                  <label class="form-check-label text-white" for="aspirant_member">
                    Aspirant lid
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="member" id="member" name="roles[]">
                  <label class="form-check-label text-white" for="member">
                    Lid
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="management" id="management" name="roles[]">
                  <label class="form-check-label text-white" for="management">
                    Bestuur
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="donor" id="donor" name="roles[]">
                  <label class="form-check-label text-white" for="donor">
                    Donateur
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2">
          <div class="col">
            <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
              <div class="text-white font-weight-bold"><strong>Brevetten</strong></div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="RC motorplane" id="PlaneCertCheckbox" name="licences[]"
                >
                <label class="form-check-label text-white" for="PlaneCertCheckbox">
                  Motorvliegtuig
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="RC helicopter" id="HeliCertCheckbox" name="licences[]"
                >
                <label class="form-check-label text-white" for="HeliCertCheckbox">
                  Helicopter
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="RC glider" id="gliderCertCheckbox" name="licences[]"
                >
                <label class="form-check-label text-white" for="gliderCertCheckbox">
                  Zweefvliegtuig
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="RC multicopter" id="multicopterCertCheckbox" name="licences[]">
                <label class="form-check-label text-white" for="multicopterCertCheckbox">
                  Multicopter
                </label>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="pt-2 pb-2 ps-2 pe-2 mb-2 mt-2 w-25">
              <div class="text-white font-weight-bold"><strong>Drone</strong></div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Drone A1" id="droneA1Checkbox" name="licences[]"
                >
                <label class="form-check-label text-white" for="droneA1Checkbox">
                  A1
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Drone A2" id="droneA2Checkbox" name="licences[]"
                >
                <label class="form-check-label text-white" for="droneA2Checkbox">
                  A2
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Drone A3" id="droneA3Checkbox" name="licences[]"
                       )>
                <label class="form-check-label text-white" for="droneA3Checkbox">
                  A3
                </label>
              </div>
            </div>
          </div>
          <button type="submit" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Toevoegen</button>
        </div>
      </form>
    </div>
  </div>
@endsection
