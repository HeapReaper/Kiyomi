@extends('panel::layouts.master')

@section('title', 'Paneel')

@section('content')
  <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

  <main>
    <!-- Total container-->
    <div class="container">
      <!-- Total -->
      <h1 class="text-white mt-4">Vluchten overzicht</h1>
      <!-- Total cards -->
      <div class="row">
        <!-- Total flights -->
        <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-75 rounded m-2">
          <h3 class="text-white mt-2">Totaal:</h3>
          <h1 class="text-white"></h1>
        </div>
        <!-- This week flights -->
        <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-75 rounded m-2">
          <h3 class="text-white mt-2">Deze week:</h3>
          <h1 class="text-white"></h1>
        </div>
        <!-- Today flights -->
        <div class="col-sm text-center ml-2 mr-2 mt-2 bg-dark bg-opacity-75 rounded m-2">
          <h3 class="text-white mt-2">Vandaag:</h3>
          <h1 class="text-white"></h1>
        </div>
      </div>
      <!-- End total cards -->
    </div>

    <!-- Table last flights -->
    <div class="container bg-dark bg-opacity-75 rounded">
      <h1 class="mt-4 text-white">Vluchten</h1>
      <div class="table-responsive">
        <table class="table table-striped text-white ml-2 mr-2">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Naam</th>
              <th scope="col">Datum</th>
              <th scope="col">Tijd</th>
              <th scope="col">Vlucht informatie</th>
              <th scope="col">Verwijder</th>
            </tr>
          </thead>
            @foreach ($flights as $flight)
              <tbody>
                <tr>
                  <th scope="row" class="text-white">{{ $flight->id }}</th>
                  <td class="text-white">{{ $flight->user[0]->name }}</td>
                  <td class="text-white">{{ explode(' ', $flight->date_time )[0] }}</td>
                  <td class="text-white">{{ explode(' ', $flight->date_time )[1] }}</td>
                  <td class="text-white">
                    @foreach ($flight->submittedModel as $model)
                      <p class="mt-0 mb-0">
                        Model {{ $loop->iteration }}: {{ Modules\Flights\Enums\ModelName::convertToName($model->model_type) }}.
                        klasse: {{ Modules\Flights\Enums\ModelPowerClassName::convertToName($model->class) }}.
                        Aantal vluchten: {{ $model->lipo_count }}
                      </p>
                    @endforeach
                  <td class="text-white text-center">
                    <form action="{{ route('flights-panel.destroy', $flight->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="confirm('Weet je zeker dat je deze vlucht wilt verwijderen?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                          <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                          <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                      </button>
                    </form>
                  </td>
                </tr>
              </tbody>
            @endforeach
        </table>
      </div>
    </div>
  </main>

  <style>
    body, html {
      background-color: #2f3031;
    }

    input[type="checkbox"] {
      width: 1.2rem;
      height: 1.2rem;
      border-radius: 50%;
    }
  </style>
@stop