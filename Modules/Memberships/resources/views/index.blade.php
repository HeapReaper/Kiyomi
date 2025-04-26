@extends('panel::layouts.master')

@section('title', 'Lidmaatschappen')

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
        @foreach($memberships as $membership)
          <tr class="text-center">
            <th scope="row" class="text-white">{{ $membership->id }}</th>
            <td class="text-white">{{ $membership->name }}</td>
            <td class="text-white">{{ Str::words($membership->description, 5) }}</td>
            <td class="text-white">€{{ $membership->price }}</td>
            <td class="text-white">
              @if ($membership->payment_frequency === 1)
                <span class="badge text-bg-success">Maandelijks</span>
              @endif

              @if ($membership->payment_frequency === 2)
                  <span class="badge text-bg-primary">Jaarlijks</span>
              @endif

            </td>
            <td class="text-white">
              @if ($membership->active)
                <span class="badge text-bg-success">Ja</span>
              @else
                <span class="badge text-bg-warning">Nee</span>
              @endif
            </td>
            <td class="text-white d-flex">
              <form action="{{ route('memberships.edit', $membership->id) }}" method="GET">
                @csrf
                <x-buttons.edit />
              </form>

              <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-buttons.delete tooltip="Weet je zeker dat je het lidmaatschap {{ $membership->name }} wilt verwijderen?"/>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  </div>
@endsection
