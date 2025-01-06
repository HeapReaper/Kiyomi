@extends('panel::layouts.master')

@section('title', 'Statistieken')

@section('content')
  <div class="m-2">

      @livewire('flights::statistics')

  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop