@extends('panel::layouts.master')

@section('title', $user->name)

@section('content')	
<div class="container-fluid col-lg-6 offset-lg-3 pt-4 pb-4">
    <div class="row bg-dark rounded bg-opacity-25">
      <div class="col-sm">
        <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
          <div class="form-group">
            <label for="name" class="text-white font-weight-bold">Volledige naam</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="fullname" placeholder="Voornaam achternaam" required value="{{ $user->name }}" disabled>
            <!-- <small id="fullname" class="form-text text-muted"></small>-->
          </div>

          <div class="form-group">
            <label for="birthdate"  class="text-white font-weight-bold">Geboortedatum</label>
            <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="01-01-2024" required value="{{ $user->birthdate }}" disabled>
          </div>
        </div>
      </div>

      <div class="col-sm">
        <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2 rounded">
          <div class="form-group">
            <label for="address"  class="text-white font-weight-bold">Adres</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Straatnaam nummer" required value="{{ $user->address }}" disabled>
          </div>

          <div class="form-group">
            <label for="postcode"  class="text-white font-weight-bold">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="1234AH (zonder spatie!)" required value="{{ $user->zip_code }}" disabled>
          </div>

          <div class="form-group">
            <label for="city"  class="text-white font-weight-bold">Woonplaats</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Woonplaats" required value="{{ $user->city }}" disabled>
          </div>
        </div>
      </div>

      <div class="col-sm">
        <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2 rounded">
          <div class="form-group">
            <label for="phone"  class="text-white font-weight-bold">Telefoon</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="0612343455 (nummer zonder streepje!)" required value="{{ $user->mobile_phone }}" disabled>
          </div>

          <div class="form-group">
            <label for="email" class="text-white font-weight-bold">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="mail@provider.nl" required value="{{ $user->email }}" disabled>
          </div>
        </div>
      </div>
    </div>

    <div class="row bg-dark rounded bg-opacity-25 mt-2">
      <div class="col-sm">
        <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
          <div class="form-group">
            <label for="rdw_number"  class="text-white font-weight-bold">RDW nummer</label>
            <input type="text" class="form-control" id="rdw_number" name="rdw_number" placeholder="A34hjhdwqjkwqa" value="{{ $user->rdw_number }}" disabled>
          </div>

          <div class="form-group">
            <label for="knvvl"  class="text-white font-weight-bold">KNVvl nummer</label>
            <input type="text" class="form-control" id="knvvl" name="knvvl" placeholder="1234567" value="{{ $user->KNVvl }}" disabled>
          </div>
        </div>
      </div>

      <div class="col-sm">
        <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
          <div class="form-group">
            <label for="role" class="text-white font-weight-bold">Rol</label>
            <select class="form-control" id="role" name="role" required disabled>
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
              <option value="" @if ($user->hasRole('super admin')) selected @endif>
                Super Admin
              </option>
            </select>
          </div> 

          <div class="form-group">
            <label for="instruct" class="text-white font-weight-bold">Instructeur</label>
            <select class="form-control" id="instruct" name="instruct" required disabled>
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
          <p class="font-weight-bold text-white mb-0">Brevetten</p>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value=1 id="PlaneCertCheckbox" name="PlaneCertCheckbox"  @if ($user->has_plane_brevet == 1) checked @endif disabled>
            <label class="form-check-label text-white" for="PlaneCertCheckbox">
              Motorvliegtuig
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value=1 id="HeliCertCheckbox" name="HeliCertCheckbox" @if ($user->has_helicopter_brevet == 1) checked @endif disabled>
            <label class="form-check-label text-white" for="HeliCertCheckbox">
              Helicopter
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value=1 id="gliderCertCheckbox" name="gliderCertCheckbox" @if ($user->has_glider_brevet == 1) checked @endif disabled>
            <label class="form-check-label text-white" for="gliderCertCheckbox">
              Zweefvliegtuig
            </label>
          </div>

          <p class="font-weight-bold text-white mb-0 mt-3">Erelid</p>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value=1 id="honoraryMemberCheckbox" name="honoraryMemberCheckbox" @if ($user->in_memoriam == 1) checked @endif disabled>
            <label class="form-check-label text-white" for="honoraryMemberCheckbox">
              Erelid
            </label>
          </div>
        </div>
      </div>
    </div>

      <div class="row bg-dark rounded bg-opacity-25 mt-2">
        <div class="col-sm">
          <div class="pt-2 pb-2 ps-2 pe-2 mb-2 mt-2 w-25">
            <h4 class="font-weight-bold text-white mb-0">Drone certificaten</h4>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="droneA1Checkbox" name="droneA1Checkbox" @if ($user->has_drone_a1 == 1) checked @endif disabled>
              <label class="form-check-label text-white" for="droneA1Checkbox">
                A1
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="droneA2Checkbox" name="droneA2Checkbox" @if ($user->has_drone_a2 == 1) checked @endif disabled>
              <label class="form-check-label text-white" for="droneA2Checkbox">
                A2
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="droneA3Checkbox" name="droneA3Checkbox" @if ($user->has_drone_a3 == 1) checked @endif disabled>
              <label class="form-check-label text-white" for="droneA3Checkbox">
                A3
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection