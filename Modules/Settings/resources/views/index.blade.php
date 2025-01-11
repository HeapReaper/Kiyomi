@extends('panel::layouts.master')

@section('title', 'Instellingen')

@section('content')
  <div class="container" style="max-width: 30%;">
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
        @foreach($roles as $role)
          @if ($role->name !== 'super admin')
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value=1 id="{{ $role->name }}" name="id="{{ $role->id }}"">
              <label class="form-check-label text-white" for="{{ $role->name }}">
                {{ $role->name }}
              </label>
            </div>
          @endif
        @endforeach
      </div>

      <button type="submit" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
        Opslaan
      </button>
    </form>
  </div>
@endsection