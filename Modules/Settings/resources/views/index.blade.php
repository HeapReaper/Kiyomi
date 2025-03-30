@extends('panel::layouts.master')

@section('title', 'Instellingen')

@section('content')
  <div class="container">
    <form action="{{ route('settings.store') }}" class="bg-dark bg-opacity-25 m-3 p-3 rounded" method="POST">
      @csrf

      <div class="mt-2 mb-2">
        <h3 class="text-white">Email</h3>
        <label for="email_new_members" class="form-label text-white">Email adres voor nieuwe leden melding</label>
        <input type="email" class="form-control" name="email_new_members" id="email_new_members" aria-describedby="email_new_members" value="{{ \App\Helpers\Settings::get('email_new_members') }}">
      </div>

      <hr style="color: white;">

      <div class="mt-2 mb-2">
        <h3 class="text-white">Leden login</h3>
        <label for="email_new_members" class="form-label text-white">Wie mag inloggen op deze website?</label>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="junior_member" id="junior_member" name="roles[]"
              @checked(str_contains(\App\Helpers\Settings::get('roles_allowed_sign_in'), 'junior_member') === true)>
            <label class="form-check-label text-white" for="junior_member">
              Junior lid
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="aspirant_member" id="aspirant_member" name="roles[]"
              @checked(str_contains(\App\Helpers\Settings::get('roles_allowed_sign_in'), 'aspirant_member') === true)>
            <label class="form-check-label text-white" for="aspirant_member">
              Aspirant lid
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="member" id="member" name="roles[]"
              @checked(str_contains(\App\Helpers\Settings::get('roles_allowed_sign_in'), 'member') === true)>
            <label class="form-check-label text-white" for="member">
              Lid
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="management" id="management" name="roles[]"
              @checked(str_contains(\App\Helpers\Settings::get('roles_allowed_sign_in'), 'management') === true)>
            <label class="form-check-label text-white" for="management">
              Bestuur
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="donor" id="donor" name="roles[]"
              @checked(str_contains(\App\Helpers\Settings::get('roles_allowed_sign_in'), 'donor') === true)>
            <label class="form-check-label text-white" for="donor">
              Donateur
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="webmaster" id="webmaster" name="roles[]"
              @checked(str_contains(\App\Helpers\Settings::get('roles_allowed_sign_in'), 'webmaster') === true)>
            <label class="form-check-label text-white" for="webmaster">
              Webmaster
            </label>
          </div>
        </div>

      </div>

      <button type="submit" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
        Opslaan
      </button>
    </form>
  </div>
@endsection
