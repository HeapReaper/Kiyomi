@extends('home::layouts.master')

@section('title', 'Wachtwoord wijzigen')

@section('content')
  <div class="m-2">
    <div class="container mt-5" style="max-width: 400px">
      <img src="/app_media/faticon.ico" class="rounded mx-auto d-block" alt="" style="width: 150px;">
      <h2 class="text-dark text-center pt-3">Wachtwoord vergeten</h2>

      <form action="{{ route('password.email') }}" method="POST" class="col-auto pt-4 pb-4 mw-50">
        @csrf
        <label for="email" class="text-dark">Email</label>
        <input type="text" class="form-control mt-2" id="email" name="email" aria-describedby="email" placeholder="Je email">

        <button type="submit" class="btn text-white mt-2 fw-bold button-subtle-animation" style="background-color: var(--primary-style-color)">Aanvragen</button>
      </form>
    </div>
  </div>
@endsection

