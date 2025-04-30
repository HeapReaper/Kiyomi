@extends('panel::layouts.master')

@section('title', 'Media')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="text-white">Media</h2>

      <a href="{{ route('media.create') }}" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
        Nieuw
      </a>
    </div>

    <div class="table-responsive">
      <table class="table table-custom-dark user-list ml-2 mr-2" >
        <thead class="text-white">
        <tr>
          <th class="text-white"><span>Bestand</span></th>
          <th class="text-white"><span>Link</span></th>
          <th class="text-white"><span>Type</span></th>
          <th class="text-white"><span>Auteur</span></th>
          <th class="text-white"><span>Gekoppeld</span></th>
          <th class="text-white"><span>Datum</span></th>
          <th class="text-white"><span>Opties</span></th>
        </tr>
        </thead>

        <tbody>
          <tr>
            <td class="text-white">
              <img src="https://placehold.co/60x60" class="rounded">
            </td>
            <td class="text-white">
              <a href="#">
                Kopieer
              </a>
            </td>
            <td class="text-white">
              Afbeelding
            </td>
            <td class="text-white">
              Kelvin de Reus
            </td>
            <td class="text-white">
              Niet
            </td>
            <td class="text-white">
              17-04-2025
            </td>
            <td class="text-white">
              <x-buttons.edit />
              <x-buttons.delete />
            </td>
          </tr>
        </tbody>
      </table>
    </div>
@stop
