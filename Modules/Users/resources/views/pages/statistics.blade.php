@extends('panel::layouts.master')

@section('title', 'Leden statistieken')

@section('content')
  <div class="m-2">
    @livewire('users::statistics')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop