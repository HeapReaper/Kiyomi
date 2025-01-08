@extends('panel::layouts.master')

@section('title', $user->name)

@section('content')
<div class="m-3">
  <div class="container-fluid">
    <form class="col-lg-6 offset-lg-3 pt-4 pb-4" action="{{ route('users.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="row bg-dark rounded bg-opacity-25 shadow-lg">
        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="name" class="text-white font-weight-bold"><strong>Volledige naam</strong></label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="fullname" placeholder="Voornaam achternaam" required value="{{ $user->name }}">
              <!-- <small id="fullname" class="form-text text-muted"></small>-->
            </div>

            <div class="form-group">
              <label for="birthdate"  class="text-white font-weight-bold"><strong>Geboortedatum</strong></label>
              <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="01-01-2024" required value="{{ date('d-m-Y', strtotime($user->birthdate)) }}">
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2 rounded">
            <div class="form-group">
              <label for="address"  class="text-white font-weight-bold"><strong>Adres</strong></label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Straatnaam nummer" required value="{{ $user->address }}">
            </div>

            <div class="form-group">
              <label for="postcode"  class="text-white font-weight-bold"><strong>Postcode</strong></label>
              <input type="text" class="form-control" id="postcode" name="postcode" placeholder="1234AH (zonder spatie!)" required value="{{ $user->zip_code }}">
            </div>

            <div class="form-group">
              <label for="city"  class="text-white font-weight-bold"><strong>Woonplaats</strong></label>
              <input type="text" class="form-control" id="city" name="city" placeholder="Woonplaats" required value="{{ $user->city }}">
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2 rounded">
            <div class="form-group">
              <label for="phone"  class="text-white font-weight-bold"><strong>Telefoon</strong></label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="0612343455 (nummer zonder streepje!)" required value="{{ $user->mobile_phone }}">
            </div>

            <div class="form-group">
              <label for="email" class="text-white font-weight-bold"><strong>E-mail</strong></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="mail@provider.nl" required value="{{ $user->email }}">
            </div>
          </div>
        </div>
      </div>

      <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2">
        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="rdw_number" class="text-white font-weight-bold"><strong>RDW nummer</strong></label>
              <input type="text" class="form-control" id="rdw_number" name="rdw_number" placeholder="A34hjhdwqjkwqa" value="{{ $user->rdw_number }}">
            </div>

            <div class="form-group">
              <label for="knvvl"  class="text-white font-weight-bold"><strong>KNVvl nummer</strong></label>
              <input type="text" class="form-control" id="knvvl" name="knvvl" placeholder="1234567" value="{{ $user->KNVvl }}">
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="role" class="text-white font-weight-bold"><strong>Rol</strong></label>
              <select class="form-control" id="role" name="role" required @if ($user->hasRole('super admin')) disabled @endif>
                <option value="junior_member" @if ($user->hasRole('junior_member')) selected @endif>
                  Jeugd lid
                </option>
                <option value="aspirant_member" @if ($user->hasRole('aspirant_member')) selected @endif>
                  Aspirant lid
                </option>
                <option value="member" @if ($user->hasRole('member')) selected @endif>
                  Lid
                </option>
                <option value="management" @if ($user->hasRole('management')) selected @endif>
                  Bestuur
                </option>
                <option value="donor" @if ($user->hasRole('donor')) selected @endif>
                  Donateur
                </option>
                <option value="not_paid" @if ($user->hasRole('not_paid')) selected @endif>
                  Niet betaald
                </option>
                <option disabled value="" @if ($user->hasRole('super admin')) selected @endif>
                  Super Admin
                </option>
              </select>
            </div> 

            <div class="form-group">
              <label for="instruct" class="text-white font-weight-bold"><strong>Instructeur</strong></label>
              <select class="form-control" id="instruct" name="instruct" required>
                <option value=0 @if ($user->instruct == 0) selected @endif>
                  Nee
                </option>
                <option value=1 @if ($user->instruct == 1) selected @endif>
                  Ja
                </option>
              </select>
            </div> 
          </div>
        </div>

        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <p class="font-weight-bold text-white mb-0"><strong>Brevetten</strong></p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="PlaneCertCheckbox" name="PlaneCertCheckbox"  @if ($user->has_plane_brevet == 1) checked @endif>
              <label class="form-check-label text-white" for="PlaneCertCheckbox">
                Motorvliegtuig
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="HeliCertCheckbox" name="HeliCertCheckbox" @if ($user->has_helicopter_brevet == 1) checked @endif>
              <label class="form-check-label text-white" for="HeliCertCheckbox">
                Helicopter
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="gliderCertCheckbox" name="gliderCertCheckbox" @if ($user->has_glider_brevet == 1) checked @endif>
              <label class="form-check-label text-white" for="gliderCertCheckbox">
                Zweefvliegtuig
              </label>
            </div>

            <p class="font-weight-bold text-white mb-0 mt-3">Erelid</p>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="honoraryMemberCheckbox" name="honoraryMemberCheckbox" @if ($user->in_memoriam == 1) checked @endif>
              <label class="form-check-label text-white" for="honoraryMemberCheckbox">
                Erelid
              </label>
            </div>
          </div>
        </div>
      </div>

        <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2">
          <div class="col-sm">
            <div class="pt-2 pb-2 ps-2 pe-2 mb-2 mt-2 w-25">
              <h4 class="font-weight-bold text-white mb-0">Drone certificaten</h4>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value=1 id="droneA1Checkbox" name="droneA1Checkbox" @if ($user->has_drone_a1 == 1) checked @endif>
                <label class="form-check-label text-white" for="droneA1Checkbox">
                  A1
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value=1 id="droneA2Checkbox" name="droneA2Checkbox" @if ($user->has_drone_a2 == 1) checked @endif>
                <label class="form-check-label text-white" for="droneA2Checkbox">
                  A2
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value=1 id="droneA3Checkbox" name="droneA3Checkbox" @if ($user->has_drone_a3 == 1) checked @endif>
                <label class="form-check-label text-white" for="droneA3Checkbox">
                  A3
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2">
          <h4 class="font-weight-bold mt-2 text-white mb-0">Toegang</h4>
          @if (Auth()->user()->id == $user->id || Auth()->user()->roles()->get()[0]->name == "bestuur" || Auth()->user()->roles()->get()[0]->name == "super admin")
            <div class="col-sm">
              <div class="form-group">
                <label for="password" class="text-white"><strong>Wachtwoord</strong></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Wachtwoord...">
              </div>
            </div>
          @endif
          <div class="col">
            <div class="pt-2 pb-2 ps-2 pe-2 mb-2 mt-2">
              <a href="" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%); padding: 4px; border-radius: 10px; color: white;">
                Verstuur een wachtwoord email (WIP)
              </a>
            </div>
          </div>

          <button type="submit" class="btn text-white mt-3" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Update</button>
        </div>

      </div>
    </form>
  </div>
</div>
  
    <style>
    .form-control {
      background-color: rgba(255, 255, 255, 0.1) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      border-radius: 5px !important;
      padding: 10px !important;
      color: white !important;
      font-size: 14px !important;
      -webkit-appearance: listbox !important;
    }

    .form-control::placeholder {
      color: white !important;
    }

    .form-control:focus {
        color: white !important;
    }

    .form-control option {
        color: #000000;
        padding: 8px 16px;
        border: 1px solid transparent;
        border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
        cursor: pointer;
    }

    .form-control option:hover {
        background-color: #d53131 !important;
        color: white !important;
    }

    .form-control:after {
      position: absolute !important;
      content: "" !important;
      top: 14px !important;
      right: 10px !important;
      width: 0 !important;
      height: 0 !important;
      border: 6px solid !important;
      border-color: #fff !important;
    }

    .form-control:focus::placeholder {
        color: transparent !important;
    }

    .form-check-input:checked {
        background-color: green;
        border-color: #2b5c93;
    }
  </style>
@endsection