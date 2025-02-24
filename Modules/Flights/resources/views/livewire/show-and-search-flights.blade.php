<div class="m-2 mb-3">
  <!-- Table last flights -->
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <h2 class="text-white font-weight-bold">Vluchten</h2>

    <div class="row">
      <div class="col ml-0">
        <div class="float-start mb-4 ms-0 mt-4">
          <input wire:model.live="search" type="text" id="name_search" name="name_search" placeholder="Zoek op naam" class="form-control rounded">
        </div>
      </div>

      <div class="col">
        <div class="float-end mb-4 ms-0 mt-4">
          <select wire:model="selectYear" wire:change="updateSelectYear"  class="form-control form-control-lg selector_custom">
            @foreach(range(2023, date('Y') + 7) as $year)
              <option value="{{ $year }}" @if ( (string) $year == date('Y')) selected @endif>
                {{ $year }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table user-list rounded text-white ml-2 mr-2">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Naam</th>
            <th scope="col">Datum</th>
            <th scope="col">Start tijd</th>
            <th scope="col">Eind tijd</th>
            <th scope="col">Model</th>
            <th scope="col">Vermogen</th>
            <th scope="col">Bewerk, verwijder</th>
          </tr>
        </thead>
          <tbody>
            @foreach ($flights as $flight)
              <tr>
                <th scope="row" class="text-white">{{ $flight->id }}</th>
                <td class="text-white">{{ $flight->user[0]->name }}</td>
                <td class="text-white">{{ date('d-m-Y', strtotime($flight->date)) }}</td>
                <td class="text-white">{{ \Carbon\Carbon::createFromFormat('H:i:s', $flight->start_time)->format('H:i') }}</td>
                <td class="text-white">{{ \Carbon\Carbon::createFromFormat('H:i:s', $flight->end_time)->format('H:i') }}</td>
                <td class="text-white">
                  <p class="mt-0 mb-0">
                    {{ Modules\Flights\Enums\ModelName::convertToName($flight->submittedModel[0]->model_type) }}
                  </p>
                <td class="text-white">
                  {{ Modules\Flights\Enums\ModelPowerClassName::convertToName($flight->submittedModel[0]->class) }}
                </td>
                <!-- Edit, delete -->
                <td style="" class="text-center">
                  <div style="display: flex;">  <form action="{{ route('flights-panel.edit', $flight->id) }}" method="GET" style="margin-right: 10px;"> @csrf
                      <button type="submit" class="table-link text-info" style="border: none; background: none; padding: 0; cursor: pointer;">
                        <span class="fa-stack" style="font-size: 1rem;">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa fa-pencil fa-stack-1x fa-inverse" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%); border-radius: 4px;"></i>
                        </span>
                      </button>
                    </form>

                    <form action="{{ route('flights-panel.destroy', $flight->id) }}" method="POST" id="delete-form-{{ $flight->id }}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="table-link text-info" onclick="return confirm('Weet je zeker dat je deze vlucht wilt verwijderen?');" style="border: none; background: none; padding: 0; cursor: pointer;">
                        <span class="fa-stack" style="font-size: 1rem;">
                          <i class="fa fa-square fa-stack-2x"></i>
                          <i class="fa fa-trash fa-stack-1x fa-inverse" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%); border-radius: 4px;"></i>
                        </span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
      {{ $flights->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
