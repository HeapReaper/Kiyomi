@extends('panel::layouts.master')

@section('title', $user->name)

@section('content')
<div class="ms-3 me-3 mt-0">
  <div class="container-fluid">
    <form class="col-lg-6 offset-lg-3 pt-4 pb-4" action="/profile/update/{{ $user->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      @livewireStyles
      <div class="row bg-dark rounded bg-opacity-25 shadow-lg">
        <h2 class="text-white font-weight-bold">Lid bewerken</h2>

        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="name" class="text-white font-weight-bold"><strong>Volledige naam</strong></label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="fullname" placeholder="Voornaam achternaam" value="{{ $user->name }}" required>
              <!-- <small id="fullname" class="form-text text-muted"></small>-->
            </div>

            <div class="form-group">
              <label for="birthdate"  class="text-white font-weight-bold"><strong>Geboortedatum</strong></label>
              <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="01-01-2024" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $user->birthdate)->format('d-m-Y') }}" required>
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="address"  class="text-white font-weight-bold"><strong>Adres</strong></label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Straatnaam nummer" value="{{ $user->address }}" required>
            </div>

            <div class="form-group">
              <label for="postcode"  class="text-white font-weight-bold"><strong>Postcode</strong></label>
              <input type="text" class="form-control" id="postcode" name="postcode" placeholder="1234AH (zonder spatie!)" value="{{ $user->zip_code }}" required>
            </div>

            <div class="form-group">
              <label for="city"  class="text-white font-weight-bold"><strong>Woonplaats</strong></label>
              <input type="text" class="form-control" id="city" name="city" placeholder="Woonplaats" value="{{ $user->city }}" required>
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="phone"  class="text-white font-weight-bold"><strong>Telefoon</strong></label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="0612343455 (nummer zonder streepje!)" value="{{ $user->mobile_phone }}" required>
            </div>

            <div class="form-group">
              <label for="email" class="text-white font-weight-bold"><strong>E-mail</strong></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="mail@provider.nl" value="{{ $user->email }}" required>
            </div>
          </div>
        </div>
      </div>

      <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2">
        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="rdw_number"  class="text-white font-weight-bold"><strong>RDW nummer</strong></label>
              <input type="text" class="form-control" id="rdw_number" name="rdw_number" placeholder="A34hjhdwqjkwqa" value="{{ $user->rdw_number }}">
            </div>

            <div class="form-group">
              <label for="knvvl"  class="text-white font-weight-bold"><strong>KNVvl nummer</strong></label>
              <input type="text" class="form-control" id="knvvl" name="knvvl" placeholder="1234567" value="{{ $user->knvvl }}">
            </div>
          </div>
        </div>


        <div class="col-sm"
        @if (!Auth::user()->hasRole(['management', 'webmaster'])) style="display: none" @endif>
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="instruct" class="text-white font-weight-bold"><strong>Instructeur</strong></label>
              <select class="form-control" id="instruct" name="instruct" required>
                <option value=0 @selected($user->instruct === 0)>Nee</option>
                <option value=1 @selected($user->instruct === 1)>Ja</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-sm"
           @if (!Auth::user()->hasRole(['management', 'webmaster'])) style="display: none" @endif>
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="role" class="text-white font-weight-bold"><strong>Rol</strong></label>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="junior_member" id="junior_member" name="roles[]"
                  @checked($user->hasRole('junior_member') === true)>
                <label class="form-check-label text-white" for="junior_member">
                  Junior lid
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="aspirant_member" id="aspirant_member" name="roles[]"
                  @checked($user->hasRole('aspirant_member') === true)>

                <label class="form-check-label text-white" for="aspirant_member">
                  Aspirant lid
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="member" id="member" name="roles[]"
                  @checked($user->hasRole('member') === true)>
                <label class="form-check-label text-white" for="member">
                  Lid
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="management" id="management" name="roles[]"
                  @checked($user->hasRole('management') === true)>
                <label class="form-check-label text-white" for="management">
                  Bestuur
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="donor" id="donor" name="roles[]"
                  @checked($user->hasRole('donor') === true)>
                <label class="form-check-label text-white" for="donor">
                  Donateur
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="webmaster" id="webmaster" name="roles[]"
                  @checked($user->hasRole('webmaster') === true)>
                <label class="form-check-label text-white" for="webmaster">
                  Webmaster
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      @if (Auth::user()->hasRole(['management', 'webmaster']))
        <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2">
        <div class="col">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="text-white font-weight-bold"><strong>Brevetten</strong></div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="RC motorplane" id="PlaneCertCheckbox" name="licences[]"
                @checked($user->licences->contains('name', 'RC motorplane'))>
              <label class="form-check-label text-white" for="PlaneCertCheckbox">
                Motorvliegtuig
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="RC helicopter" id="HeliCertCheckbox" name="licences[]"
                @checked($user->licences->contains('name', 'RC helicopter'))>
              <label class="form-check-label text-white" for="HeliCertCheckbox">
                Helicopter
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="RC glider" id="gliderCertCheckbox" name="licences[]"
                @checked($user->licences->contains('name', 'RC glider'))>
              <label class="form-check-label text-white" for="gliderCertCheckbox">
                Zweefvliegtuig
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="RC multicopter" id="multicopterCertCheckbox" name="licences[]"
                @checked($user->licences->contains('name', 'RC multicopter'))>
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
                @checked($user->licences->contains('name', 'Drone A1'))>
              <label class="form-check-label text-white" for="droneA1Checkbox">
                A1
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Drone A2" id="droneA2Checkbox" name="licences[]"
                @checked($user->licences->contains('name', 'Drone A2'))>
              <label class="form-check-label text-white" for="droneA2Checkbox">
                A2
              </label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="Drone A3" id="droneA3Checkbox" name="licences[]"
                @checked($user->licences->contains('name', 'Drone A3'))>
              <label class="form-check-label text-white" for="droneA3Checkbox">
                A3
              </label>
            </div>
          </div>
        </div>

        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="text-white font-weight-bold"><strong>Status</strong></div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="honoraryMemberCheckbox" name="honoraryMemberCheckbox"
                @checked($user->in_memoriam === 1)>
              <label class="form-check-label text-white" for="honoraryMemberCheckbox">
                Erelid
              </label>
            </div>
          </div>
        </div>
      </div>
      @endif

      <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2">
        <!-- Current profile picture -->
        <div class="col d-flex justify-content-center align-items-center" style="min-height: 80px;">
          @if ($user->profile_picture)
            <img src="{{ Storage::disk('minio')->url('pfp/' . $user->profile_picture) }}" class="img-fluid rounded-circle" style="max-width: 80px; object-fit: cover;">
          @endif
        </div>

        <!-- New profile picture -->
        <div class="col">
          <div class="mb-3">
            <label for="profile_picture" class="form-label text-white">Upload nieuwe profiel foto</label>
            <input class="form-control" type="file" id="profile_picture" name="profile_picture">
          </div>
        </div>
        <x-buttons.save />
      </div>
    </form>

    <!-- 2FA -->
    <div class="row bg-dark rounded bg-opacity-25 shadow-lg mt-2 col-lg-6 offset-lg-3 pt-4 pb-4">
      <h1 class="text-white">Totp</h1>
      <div class="col d-flex justify-content-center align-items-center" style="min-height: 80px;">

        @if (auth()->user()?->hasEnabledTwoFactorAuthentication())
          <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
            @csrf
            @method('DELETE')
            <x-buttons.off />
         </form>
        @else
          <form class="col-lg-6 offset-lg-3 pt-4 pb-4" method="POST" action="{{ url('/user/two-factor-authentication') }}">
            @csrf
            <x-buttons.on />
          </form>
        @endif
      </div>

      <div class="col">
        <div class="mt-2 mb-2">
          @if (auth()->user()->two_factor_secret)
            <div>
              {!! auth()->user()->twoFactorQrCodeSvg() !!}
            </div>

            <form method="POST" action="{{ route('two-factor.confirm') }}">
              @csrf

              <div class="form-group">
                <label for="name" class="text-white font-weight-bold"><strong>TOTP code</strong></label>
                <input type="text" class="form-control" id="code" name="code" aria-describedby="TOTP code" required>
              </div>
              <x-buttons.on />
            </form>
          @endif
        </div>
        @if (auth()->user()->two_factor_recovery_codes)
          <ul>
            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
              <li>{{ $code }}</li>
            @endforeach
          </ul>
        @endif
      </div>
    </div>
  </div>
</div>
    @livewireScripts
@endsection
