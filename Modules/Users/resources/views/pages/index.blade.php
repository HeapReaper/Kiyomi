@extends('panel::layouts.master')

@section('title', 'Leden')

@section('content')
  <div class="container mt-2">
    @livewire('users::show-and-search-users')
  </div>

  <style>
    body{
        background:#eee;
    }

  </style>
@endsection