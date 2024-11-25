@extends('panel::layouts.master')

@section('title', 'Instellingen')

@section('content')
  <div class="container" style="max-width: 30%;">
    <form action="{{ route('settings.store') }}" class="bg-dark bg-opacity-25 m-3 p-3 rounded" method="POST">
      @csrf

      <h3>Email</h3>
      <div class="mb-3">
        <label for="email_new_members" class="form-label text-white">Email adres voor nieuwe leden melding</label>
        <input type="email" class="form-control" name="email_new_members" id="email_new_members" aria-describedby="email_new_members" value="{{ \App\Helpers\Settings::get('email_new_members') }}">
      </div>

      <button type="submit" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
        Opslaan
      </button>
    </form>
  </div>
@endsection