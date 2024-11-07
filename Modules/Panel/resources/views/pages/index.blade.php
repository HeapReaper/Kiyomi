@extends('panel::layouts.master')

@section('title', 'Paneel')

@section('content')
  <!-- Total container-->
  <div class="container">
    <h1 class="text-white mt-4">Admin home</h1>

    <!-- Total -->
    <h3 class="text-white mt-4">Vluchten overzicht</h3>
    <!-- Total cards -->
    <div class="row">
      <!-- Total flights -->
      <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-50 rounded m-2">
        <h3 class="text-white mt-2">Totaal:</h3>
        <h1 class="text-white">0</h1>
      </div>
      <!-- This week flights -->
      <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-50 rounded m-2">
        <h3 class="text-white mt-2">Deze week:</h3>
        <h1 class="text-white">0</h1>
      </div>
      <!-- Today flights -->
      <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-50 rounded m-2">
        <h3 class="text-white mt-2">Vandaag:</h3>
        <h1 class="text-white">0</h1>
      </div>
    </div>
    <!-- End total cards -->
  </div>

  <div class="container">
    <!-- Total -->
    <h3 class="text-white mt-4">Leden overzicht</h3>
    <!-- Total cards -->
    <div class="row">
      <!-- Total flights -->
      <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-50 rounded m-2">
        <h3 class="text-white mt-2">Totaal ingeschreven:</h3>
        <h1 class="text-white">0</h1>
      </div>
      <!-- This week flights -->
      <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-50 rounded m-2">
        <h3 class="text-white mt-2">Leden</h3>
        <h1 class="text-white">0</h1>
      </div>
      <!-- Today flights -->
      <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-50 rounded m-2">
        <h3 class="text-white mt-2">Donateurs:</h3>
        <h1 class="text-white">0</h1>
      </div>
    </div>
    <!-- End total cards -->
  </div>
@stop