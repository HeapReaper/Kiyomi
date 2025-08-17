@extends('home::layouts.master')

@section('title', 'Login')

@section('content')
  <div class="m-2">
    <div class="container mt-5 bg-dark bg-opacity-25 rounded shadow-lg p-2" style="max-width: 400px">
      <h2 class="text-white text-center pt-3">Inloggen</h2>

      <form class="col-auto pt-4 pb-4 mw-50" METHOD="POST" action="/login-post">
        @csrf
        <label for="email" class="text-white"><strong>Email</strong></label>
        <input type="text" class="form-control mt-2" id="email" name="email" placeholder="">
        @error('email') <span class="text-danger">{{ $message }}</span> @enderror

        <label for="password" class="text-white"><strong>Wachtwoord</strong></label>
        <input type="password" class="form-control mb-2" id="password" name="password" placeholder="">

        <button type="submit" class="btn text-white mt-2" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Inloggen</button>
      </form>

      <small class="text-white">Wachtwoord vergeten? Vraag <a href="{{ route('password.request') }}">hier</a> een nieuwe aan.</small>
    </div>
  </div>
@endsection
