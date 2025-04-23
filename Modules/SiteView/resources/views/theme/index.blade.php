@extends('panel::layouts.master')

@section('title', 'Thema')

@section('content')
  <div class="container">
    <div class="row mt-4 m-2 bg-dark bg-opacity-25 shadow-lg rounded">
      <h2 class="text-white">Thema</h2>

      <div class="col">
        <form action="{{ route('theme.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="colorPicker" class="form-label text-white">
              Selecteer een thema kleur:
            </label>
            <input type="color" class="form-control form-control-color" id="primary-site-theme-color" name="primary-site-theme-color" value="">
          </div>

          <x-buttons.save />
        </form>
      </div>

      <div class="col mb-4">
        <iframe src="/" class="rounded" style="height: 400px; width: 350px" id="websitePreview"></iframe>
      </div>
    </div>
  </div>
@stop
