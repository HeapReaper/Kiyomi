@extends('panel::layouts.master')

@section('title', 'Paneel')

@section('content')
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