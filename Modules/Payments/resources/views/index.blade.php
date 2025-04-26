@extends('panel::layouts.master')

@section('title', 'Betalingen')

@section('content')
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="text-white">Betalingen</h2>

      <a href="{{ route('payments.create') }}" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
        Nieuwe betaling
      </a>
  </div>

  <h3 class="text-white">Aankomende betalingen</h3>
  <table class="table table-custom-dark user-list ml-2 mr-2" >
    <thead>
      <tr class="text-center">
        <th scope="col" class="text-white">#</th>
        <th scope="col" class="text-white">Naam</th>
        <th scope="col" class="text-white">Type</th>
        <th scope="col" class="text-white">Periode</th>
        <th scope="col" class="text-white">Gemaakt op</th>
        <th scope="col" class="text-white">Verloop op</th>
        <th scope="col" class="text-white">Bedrag</th>
        <th scope="col" class="text-white">Opties</th>
      </tr>
    </thead>

    <tbody>
      <tr class="text-center">
        <th scope="row" class="text-white">1</th>
        <td class="text-white">
          <a href="#">Kelvin de Reus</a>
        </td>
        <td class="text-white">
          Lid lidmaatschap
        </td>
        <td class="text-white">2025</td>
        <td class="text-white">26-04-2025</td>
        <td class="text-white">10-05-2025</td>
        <td class="text-white">€60</td>
        <td class="d-flex">
          <form>
            <x-buttons.edit />
          </form>
        </td>
      </tr>
    </tbody>
  </table>

  <br>

  <h3 class="text-white">Verlopen betalingen</h3>
  <table class="table table-custom-dark user-list ml-2 mr-2" >
    <thead>
      <tr class="text-center">
        <th scope="col" class="text-white">#</th>
        <th scope="col" class="text-white">Naam</th>
        <th scope="col" class="text-white">Type</th>
        <th scope="col" class="text-white">Periode</th>
        <th scope="col" class="text-white">Gemaakt op</th>
        <th scope="col" class="text-white">Verlopen op</th>
        <th scope="col" class="text-white">Bedrag</th>
        <th scope="col" class="text-white">Opties</th>
      </tr>
    </thead>

    <tbody>
      <tr class="text-center">
        <th scope="row" class="text-white">1</th>
        <td class="text-white">
          <a href="#">Kelvin de Reus</a>
        </td>
        <td class="text-white">
          Lid lidmaatschap
        </td>
        <td class="text-white">2025</td>
        <td class="text-white">12-04-2025</td>
        <td class="text-white">26-04-2025</td>
        <td class="text-white">€60</td>
        <td class="d-flex">
          <form>
            <x-buttons.edit />
          </form>
        </td>
      </tr>
    </tbody>
  </table>
@stop
