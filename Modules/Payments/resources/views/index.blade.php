@extends('panel::layouts.master')

@section('title', 'Betalingen')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="text-white">Betalingen</h2>

      <a href="{{ route('payments.create') }}" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
        Nieuwe betaling
      </a>
  </div>

  <h4 class="text-white">Aankomende betalingen</h4>
@stop
