@extends('panel::layouts.master')

@section('title', 'Bewerk vlucht')

@section('content')
  <div class="container-fluid">
    <form class="col-lg-6 offset-lg-3 pt-4 pb-4" action="" method="POST">
      @csrf
      @method('PUT')

      @livewireStyles
      <div class="row bg-dark rounded bg-opacity-25 shadow-lg">
        <div class="col-sm">
          <div class="pt-2 pb-2 pl-2 pr-2 mb-2 mt-2">
            <div class="form-group">
              <label for="name" class="text-white font-weight-bold"><strong>Volledige naam</strong></label>
              <input type="text" class="form-control" id="name" name="name" aria-describedby="fullname" placeholder="Voornaam achternaam" required value="">
              <!-- <small id="fullname" class="form-text text-muted"></small>-->
            </div>

            <div class="form-group">
              <label for="birthdate"  class="text-white font-weight-bold"><strong>Geboortedatum</strong></label>
              <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="01-01-2024" required value="">
            </div>
          </div>
        </div>

        <div class="col">

        </div>
      </div>
    </form>
  </div>
@stop
