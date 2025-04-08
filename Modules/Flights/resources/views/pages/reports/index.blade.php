@extends('panel::layouts.master')

@section('title', 'Vlucht rapportages')

@section('content')
  <div class="container">
    <div class="row mt-4 m-2 bg-dark bg-opacity-25 shadow-lg rounded">
      <h2 class="text-white font-weight-bold">Vlucht rapportages</h2>
      <div class="col-sm p-2 mt-2">
        <h4 class="text-white">Maak rapportage</h4>
        <form action="{{ route('flights-report.store') }}" method="POST">
          @csrf
          <div class="card-transparant">
            <div class="card-body">
              <label for="start_date" class="text-white">Start datum</label>
              <input id="start_date" name="start_date" class="form-control" style="max-width: 50%;" type="date" />

              <label for="end_date" class="text-white">Eind datum</label>
              <input id="end_date" name="end_date" class="form-control" style="max-width: 50%;" type="date" />

              <button type="submit" class="btn mt-2 text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Genereer</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row mt-4 m-2 bg-dark bg-opacity-25 shadow-lg rounded">
      <div class="col p-2 mt-2">
        <h4 class="text-white">Gemaakte rapportages</h4>
        @livewire('flights::show-flight-reports')
      </div>
    </div>
  </div>

  <style>
    .form-control {
      background-color: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 5px;
      padding: 10px;
      color: #fff;
      font-size: 14px;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.2);
    }

    #start_date {
      margin-bottom: 15px;
    }
  </style>
@stop
