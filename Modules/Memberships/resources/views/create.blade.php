@extends('panel::layouts.master')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <h2 class="text-white">Nieuw lidmaatschap</h2>

    <form action="{{ route('memberships.store') }}" method="POST" >
      @csrf
      <div class="form-group mb-3">
        <label for="name" class="text-white font-weight-bold"><strong>Naam</strong></label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Bijvoorbeeld Donateurs, junior lid" value="{{ old('name') }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="description" class="text-white font-weight-bold"><strong>Beschrijving</strong></label>
        <textarea class="form-control" id="description" name="description" aria-describedby="description" required rows="3">
        </textarea>
      </div>

      <div class="form-group mb-3">
        <label for="price" class="text-white font-weight-bold"><strong>Prijs (€)</strong></label>
        <input type="number" step="1" class="form-control" id="price" name="price" aria-describedby="price" placeholder="" value="{{ old('price') }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="payment_frequency" class="text-white font-weight-bold"><strong>Betaal frequentie</strong></label>
        <select class="form-control" id="payment_frequency" name="payment_frequency" required>
          <option value=1 selected>
            Per maand
          </option>
          <option value=12>
            Per jaar
          </option>
        </select>
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="active" name="active">
        <label class="form-check-label text-white" for="active"><strong>Actief</strong></label>
      </div>

      <x-buttons.save />
    </form>
  </div>
@endsection
