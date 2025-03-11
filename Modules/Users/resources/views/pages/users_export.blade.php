@extends('panel::layouts.master')

@section('title', 'Leden exporteren')

@section('content')
  <div class="m-2">
    @livewire('users::statistics')
  </div>

@stop