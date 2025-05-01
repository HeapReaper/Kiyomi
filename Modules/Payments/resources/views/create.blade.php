@extends('panel::layouts.master')

@section('title', 'Betaling nieuw')

@section('content')
  @vite(['Modules/Payments/resources/assets/js/app.js'])

  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <h2 class="text-white">Nieuwe betaling</h2>

    <form action="{{ route('payments.store') }}" method="POST">
      <div class="form-group mb-3">
        <label for="for" class="text-white font-weight-bold"><strong>Voor</strong></label>
        <input list="options" name="for" id="for" class="form-control" placeholder="Typ om te zoeken..." required>
        <datalist id="options">
          @foreach($payments as $payment)
            <option value="{{  $payment->id . '_' . str_replace(' ', '_', $payment->user->name . '_€' . $payment->amount) }}">
          @endforeach
        </datalist>
      </div>

      <div class="form-group mb-3">
        <label for="date" class="text-white font-weight-bold"><strong>Datum</strong></label>
        <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="amount" class="text-white font-weight-bold"><strong>Hoeveelheid (€)</strong></label>
        <input type="number" step="1" class="form-control" id="amount" name="amount" aria-describedby="amount" placeholder="" value="{{ old('amount') }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="method" class="text-white font-weight-bold"><strong>Betalingsmethode</strong></label>
        <select class="form-control" id="method" name="method" required>
          <option value=0 selected disabled>
            Selecteer
          </option>
          <option value=2>
            Bankoverschrijving
          </option>
          <option value=1>
            Contant
          </option>
          <option value=3>
            iDeal
          </option>
        </select>
      </div>

      <x-buttons.send />
    </form>
  </div>
@stop
