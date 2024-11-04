<div>
  <!-- Table last flights -->
  <div class="container bg-dark bg-opacity-75 rounded">
    <h1 class="mt-4 text-white">Vluchten</h1>
    <!--
    <div class="row">
      <div class="col ml-0">
        <div class="float-start mb-4 ms-1 mt-2">
          <input wire:model.live="search" type="text" id="name_search" placeholder="Naam" class="form-control rounded">
        </div>
      </div>
    </div>
    -->
    <div class="table-responsive">
      <table class="table table-borderless table-striped table-dark user-list rounded text-white ml-2 mr-2">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Naam</th>
            <th scope="col">Datum</th>
            <th scope="col">Start tijd</th>
            <th scope="col">Eind tijd</th>
            <th scope="col">Model</th>
            <th scope="col">Vermogen</th>
            <th scope="col">Verwijder</th>
          </tr>
        </thead>
          <tbody>
            @foreach ($flights as $flight)
              <tr>
                <th scope="row" class="text-white">{{ $flight->id }}</th>
                <td class="text-white">{{ $flight->user[0]->name }}</td>
                <td class="text-white">{{  $flight->date }}</td>
                <td class="text-white">{{ $flight->start_time }}</td>
                <td class="text-white">{{ $flight->end_time }}</td>
                <td class="text-white">
                  <p class="mt-0 mb-0">
                    {{ Modules\Flights\Enums\ModelName::convertToName($flight->submittedModel[0]->model_type) }}
                  </p>
                <td class="text-white">
                  {{ Modules\Flights\Enums\ModelPowerClassName::convertToName($flight->submittedModel[0]->class) }}
                </td>
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
          @endforeach
        </tbody>
      </table>
      {{ $flights->links() }}
    </div>
  </div>
</div>
