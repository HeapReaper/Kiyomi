@extends('home::layouts.master')

@section('title', 'Nieuw wachtwoord')

@section('content')
  <div class="container" style="max-width: 400px">
    <img src="/app_media/faticon.ico" class="rounded mx-auto d-block" alt="" style="width: 150px;">
    <h2 class="text-dark text-center pt-3">Nieuw wachtwoord</h2>

    <form action="{{ route('password.update') }}" method="POST" class="col-auto pt-4 pb-4 mw-50">
      @csrf

      <input type="hidden" name="token" value="{{ request('token') }}">
      <input type="hidden" name="email" value="{{ request('email') }}">
      <label for="password" class="text-dark">Wachtwoord</label>
      <input type="password" class="form-control mt-2" id="password" name="password" aria-describedby="email" placeholder="">

      <label for="password_confirmation" class="text-dark">Wachtwoord bevestiging</label>
      <input type="password" class="form-control mt-2" id="password_confirmation" name="password_confirmation" aria-describedby="email" placeholder="">

      <button type="submit" class="btn text-white fw-bold mt-2 button-subtle-animation" style="background-color: var(--primary-style-color);">Reset</button>
    </form>
  </div>

@endsection
