@extends('panel::layouts.master')

@section('title', 'Statistieken')

@section('content')
  <div class="m-2">
    <h1>Hoi</h1>

    <div class="container bg-dark bg-opacity-25 text-white rounded" style="width: 50%; height: 400px;">
      {!! $chart->container() !!}
    </div>
  </div>

  {!! $chart->script() !!}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop