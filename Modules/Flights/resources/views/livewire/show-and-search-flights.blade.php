<div class="m-2 mb-3">
  <!-- Table last flights -->
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <h2 class="text-white font-weight-bold">Vluchten</h2>

    <div class="row">
      <div class="col ml-0">
        <div class="float-start mb-4 ms-0 mt-4">
          <x-livewire.searchInput />
        </div>
      </div>

      <div class="col">
        <div class="float-end mb-4 ms-0 mt-4">
          <x-livewire.selectYear />
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-custom-dark user-list ml-2 mr-2" >
        <thead>
          <tr>
            <th scope="col" class="text-white">ID</th>
            <th scope="col" class="text-white">Naam</th>
            <th scope="col" class="text-white">Datum</th>
            <th scope="col" class="text-white">Start tijd</th>
            <th scope="col" class="text-white">Eind tijd</th>
            <th scope="col" class="text-white">Model</th>
            <th scope="col" class="text-white">Vermogen</th>
            @if (Auth::user()->hasRole(['management', 'webmaster']))
              <th scope="col" class="text-white">Opties</th>
            @endif
          </tr>
        </thead>
          <tbody>
            @foreach ($flights as $flight)
              <tr>
                <th scope="row" class="text-white">
                  {{ $flight->id }}
                </th>
                <td class="text-white">
                  {{ $flight->user[0]->name }}
                </td>
                <td class="text-white">
                  {{ date('d-m-Y', strtotime($flight->date)) }}
                </td>
                <td class="text-white">
                  {{ \Carbon\Carbon::createFromFormat('H:i:s', $flight->start_time)->format('H:i') }}
                </td>
                <td class="text-white">
                  {{ \Carbon\Carbon::createFromFormat('H:i:s', $flight->end_time)->format('H:i') }}
                </td>
                <td class="text-white">
                  <p class="mt-0 mb-0">
                    {{ Modules\Flights\Enums\ModelName::convertToName($flight->submittedModel[0]->model_type) }}
                  </p>
                <td class="text-white">
                  {{ Modules\Flights\Enums\ModelPowerClassName::convertToName($flight->submittedModel[0]->class) }}
                </td>
                @if (Auth::user()->hasRole(['management', 'webmaster']))
                  <!-- Edit, delete -->
                  <td style="" class="text-center">
                    <div style="display: flex;">
                      <form action="{{ route('flights-panel.edit', $flight->id) }}" method="GET" style="margin-right: 10px;">
                        @csrf
                        <x-buttons.edit />
                      </form>

                      <form action="{{ route('flights-panel.destroy', $flight->id) }}" method="POST" id="delete-form-{{ $flight->id }}">
                        @csrf
                        @method('DELETE')
                        <x-buttons.delete tooltip="Weet je zeker dat je deze vlucht wilt verwijderen?" />
                      </form
                    </div>>
                  </td>
                @endif
              </tr>
          @endforeach
        </tbody>
      </table>
      {{ $flights->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
