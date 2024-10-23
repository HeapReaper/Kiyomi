@extends('panel::layouts.master')

@section('title', 'Leden')

@section('content')
  <div class="container-fluid">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <div class="container bootstrap mt-4 pl-0">
      <div class="row mt-3 mb-4">
        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal ingeschreven</h3>
          <h1>0</h1>
        </div>

        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal leden</h3>
          <h1>0</h1>
        </div>

        <div class="col-sm  ml-2 mr-2 text-center text-white">
          <h3>Aantal donateurs</h3>
          <h1>0</h1>
        </div>
      </div>
        @livewire('show-users')
    </div>
  </div>

  <style>
    body{
        background:#eee;
    }

  </style>
@endsection