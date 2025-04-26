@extends('panel::layouts.master')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="text-white">Lidmaatschappen</h2>

      <a href="{{ route('memberships.create') }}" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
        <i class="fas fa-plus"></i> Nieuw lidmaatschap
      </a>
    </div>

    <table class="table table-custom-dark user-list ml-2 mr-2" >
      <thead>
        <tr class="text-center">
          <th scope="col" class="text-white">#</th>
          <th scope="col" class="text-white">Naam</th>
          <th scope="col" class="text-white">Beschrijving</th>
          <th scope="col" class="text-white">Prijs</th>
          <th scope="col" class="text-white">Betaal frequentie</th>
          <th scope="col" class="text-white">Actief</th>
          <th scope="col" class="text-white">Opties</th>
        </tr>
      </thead>

      <tbody>
        <tr class="text-center">
          <th scope="row" class="text-white">1</th>
          <td class="text-white">Donateur</td>
          <td class="text-white">Het lidmaatschap voor donateurs</td>
          <td class="text-white">€50,-</td>
          <td class="text-white">
            <span class="badge text-bg-success">Maandelijks</span>
          </td>
          <td class="text-white">
            <span class="badge text-bg-success">Ja</span>
          </td>
          <td class="text-white d-flex">
            <form>
              @csrf
              <x-buttons.edit />
            </form>

            <form>
              @csrf
              <x-buttons.delete tooltip="Weet je zeker dat je dit lidmaatschap wilt verwijderen?"/>
            </form>
          </td>
        </tr>
      </tbody>
    </table>

  </div>
@endsection
