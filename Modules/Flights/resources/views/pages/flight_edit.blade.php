@extends('panel::layouts.master')

@section('title', 'Bewerk vlucht')

@section('content')
  <div class="container-fluid">
    <form class="col-lg-6 offset-lg-3 pt-4 pb-4" action="" method="POST">
      @csrf
      @method('PUT')

      @livewireStyles
      <div class="row bg-dark rounded bg-opacity-25 shadow-lg">
        <div class="col-sm">
          <div>

          </div>
        </div>

        <div class="col">

        </div>
      </div>
    </form>
  </div>
@stop
