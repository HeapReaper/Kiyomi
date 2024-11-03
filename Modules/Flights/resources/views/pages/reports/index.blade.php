@extends('panel::layouts.master')

@section('title', 'Vlucht rapportages')

@section('content')
  <div class="container">
    <div class="row mt-4">
      <!-- Manual make new report from specific dates -->
      <div class="col-sm bg-dark bg-opacity-75 rounded p-2 m-2">
        <h6 class="text-white">Maak rapportage</h6>
        <form action="{{ route('flights-report.store') }}" method="POST">
          @csrf
          <div class="card-transparant">
            <div class="card-body">
              <label for="start_date" class="text-white">Start datum</label>
              <input id="start_date" name="start_date" class="form-control" style="max-width: 50%;" type="date" />

              <label for="end_date" class="text-white">Eind datum</label>
              <input id="end_date" name="end_date" class="form-control" style="max-width: 50%;" type="date" />

              <button type="submit" class="btn btn-success mt-2">Genereer</button>
            </div>
          </div>
        </form>
      </div>

      <!-- Show manual generated flight-reports -->
      <div class="col bg-dark bg-opacity-75 rounded p-2 m-2">
        <h6 class="text-white">Handmatige rapportages</h6>
        <div class="overflow-auto" style="max-height: 180px">
          @foreach ($reports as $report)
            <p class="text-white">{{ $report }}</p>
          @endforeach
        </div>
      </div>


  </div>
@stop