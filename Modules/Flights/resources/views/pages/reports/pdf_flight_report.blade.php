<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Twentse Radio Modelvliegtuig club</h1>

    <hr>

    <h4>Vluchten van: {{ $start_date }} tot {{ $end_date }}</h4>

    <hr>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Datum</th>
          <th scope="col">Start tijd</th>
          <th scope="col">Eind tijd</th>
          <th scope="col">Model</th>
          <th scope="col">Vermogen</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($flights as $flight)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ date('d-m-Y', strtotime($flight->date)) }}</td>
            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $flight->start_time)->format('H:i') }}</td>
            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $flight->end_time)->format('H:i') }}</td>
            <td>
              {{ Modules\Flights\Enums\ModelName::convertToName($flight->submittedModel[0]->model_type) }}
            </td>
            <td>
              {{ Modules\Flights\Enums\ModelPowerClassName::convertToName($flight->submittedModel[0]->class) }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>