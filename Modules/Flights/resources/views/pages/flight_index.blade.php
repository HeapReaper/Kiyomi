@extends('panel::layouts.master')

@section('title', 'Paneel')

@section('content')

    <div class="m-2">
      <!-- Total container-->
      <div class="container bg-dark bg-opacity-25 rounded p-2">
        <!-- Total -->
        <h1 class="text-white mt-4">Vluchten overzicht</h1>
        <!-- Total cards -->
        <div class="row m-2">
          <!-- Total flights -->
          <div class="col-sm text-center mt-2">
            <h3 class="text-white mt-2">Totaal:
              <br>
              {{ count($flights) }}
            </h3>
            <h1 class="text-white"></h1>
          </div>
          <!-- This week flights -->
          <div class="col-sm text-center mt-2">
            <h3 class="text-white mt-2">Deze week:</h3>
            <h3 class="text-white">w.i.p.</h3>
          </div>
          <!-- Today flights -->
          <div class="col-sm text-center  mt-2">
            <h3 class="text-white mt-2">Vandaag:</h3>
            <h3 class="text-white">w.i.p.</h3>
          </div>
        </div>
        <!-- End total cards -->
      </div>
    </div>
    @livewire('flights::show-and-search-flights')
  </main>

  <style>
    body, html {
    }

    input[type="checkbox"] {
      width: 1.2rem;
      height: 1.2rem;
      border-radius: 50%;
    }
  </style>
@stop