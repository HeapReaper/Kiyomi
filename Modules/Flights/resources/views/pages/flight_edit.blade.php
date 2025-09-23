@extends('panel::layouts.master')

@section('title', 'Bewerk vlucht')

@section('content')
  <div class="container-fluid " >
    <form class="col-lg-6 offset-lg-3 pt-4 pb-4" action="{{ route('flights-panel.update', $flight->id) }}" method="POST">
      @csrf
      @method('PUT')


      @livewireStyles
      <input type="text" hidden id="hidden_flight_date" value="{{ \Carbon\Carbon::parse($flight->date )->format('d-m-Y') }}">

      <div class="bg-dark rounded bg-opacity-25 shadow-lg p-2">
        <h2 class="text-white font-weight-bold">Bewerk vlucht</h2>

        <div class="row">
          <div class="col-sm">
            <div class="mt-2 mb-2">
              <div class="form-group">
                <label for="name" class="text-white font-weight-bold mb-1">
                  <strong>Naam</strong>
                </label>
                <select class="form-control" id="user_id" name="user_id" required>
                  @foreach($users as $user)
                    <option value="{{ $user->id }}" @if ($flight->user[0]->id == $user->id) selected @endif>{{ $user->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="mt-2 mb-2">
              <label for="date" class="text-white font-weight-bold mb-1">
                <strong>Datum</strong>
              </label>
              <input type="text" id="date" name="date" class="form-control" placeholder="Selecteer datum" value="{{ $flight->date }}" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-group">
              <p class="text-white font-weight-bold"><strong>Start tijd:</strong></p>
              <input type="time" id="start_time" name="start_time" class="form-control" value="{{ $flight->start_time }}" required>
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <p class="text-white font-weight-bold"><strong>Eind tijd:</strong></p>
              <input type="time" id="end_time" name="end_time" class="form-control" value="{{ $flight->end_time }}" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <!-- MODEL TYPE -->
            <div class="form-group mt-2">
              <p class="text-white font-weight-bold"><strong>Model type:</strong></p>
              <select class="form-control" id="model_type" name="model_type">
                <option value=1 @if ($flight->submittedModel[0]->model_type == 1) selected @endif>Motor vliegtuig</option>
                <option value=2 @if ($flight->submittedModel[0]->model_type == 2) selected @endif>Zweef vliegtuig (zonder motor)</option>
                <option value=5 @if ($flight->submittedModel[0]->model_type == 5) selected @endif>Motor zweefvliegtuig</option>
                <option value=3 @if ($flight->submittedModel[0]->model_type == 3) selected @endif>Helikopter</option>
                <option value=4 @if ($flight->submittedModel[0]->model_type == 4) selected @endif>Drone</option>
              </select>
            </div>
          </div>

          <div class="col">
            <!-- POWER TYPE -->
            <div class="form-group mt-2">
              <p class="text-white font-weight-bold"><strong>Model vermogen:</strong></p>
              <select class="form-control" id="power_type" name="power_type">
                <option value=4 @if ($flight->submittedModel[0]->class == 4) selected @endif>0W</option>
                <option value=1 @if ($flight->submittedModel[0]->class == 1) selected @endif>< 300W</option>
                <option value=2 @if ($flight->submittedModel[0]->class == 2) selected @endif>300W-1200W</option>
                <option value=3 @if ($flight->submittedModel[0]->class == 3) selected @endif>1200W-3000W</option>
              </select>
            </div>
          </div>
        </div>
        <button type="submit" class="btn text-white mt-3" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Update</button>
      </div>
    </form>
  </div>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
          flatpickr('#date', {
              dateFormat: 'd-m-Y',
              defaultDate: document.getElementById('hidden_flight_date').value,
              allowInput: true
          });
      });
  </script>
@stop
