@extends('panel::layouts.master')

@section('title', 'Betaling nieuw')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <h2 class="text-white">Nieuwe betaling</h2>

    <form action="{{ route('payments.store') }}" method="POST">
      <div class="form-group mb-3">
        <label for="method" class="text-white font-weight-bold"><strong>Betalingsmethode</strong></label>
        <select class="form-control" id="method" name="method" required>
          <option value=1 selected>
            Contant
          </option>
          <option value=2>
            Bankoverschrijving
          </option>
          <option value=3>
            iDeal
          </option>
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="type" class="text-white font-weight-bold"><strong>Type</strong></label>
        <select class="form-control" id="type" name="type" required>
          <option value=1 selected>
            Lidmaatschap
          </option>
          <option value=2>
            Donatie
          </option>
          <option value=3>
            Subsidie
          </option>
          <option value=4>
            Overig
          </option>
        </select>
      </div>
    </form>
  </div>
@stop
