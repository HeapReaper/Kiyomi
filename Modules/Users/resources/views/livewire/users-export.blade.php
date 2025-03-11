@section('title', 'Leden exporteren')

<div>
  <div class="container bg-dark bg-opacity-25 rounded shadow-lg mt-2 p-2">
    <h2 class="text-white font-weight-bold">Leden exporteren</h2>

    <h5 class="text-white font-weight-bold">Welke leden wil je exporteren?</h5>

    <div class="row">
      <div class="col">
        <form action="{{ route('users-export.store')  }}" class="" method="POST">
          @csrf
          <div class="form-check m-1">
            <input class="form-check-input" type="checkbox" value="junior_member" id="junior_members" name="include_members[]" style="width: 20px; height: 20px">
            <label class="form-check-label text-white" for="flexCheckDefault">
              <strong>Jeugd leden</strong>
            </label>
          </div>

          <div class="form-check m-1">
            <input class="form-check-input" type="checkbox" value="aspirant_member" id="aspirant_member" name="include_members[]" style="width: 20px; height: 20px">
            <label class="form-check-label text-white" for="aspirant_member">
              <strong>Aspirant leden</strong>
            </label>
          </div>

          <div class="form-check m-1">
            <input class="form-check-input" type="checkbox" value="member" id="member" name="include_members[]" style="width: 20px; height: 20px">
            <label class="form-check-label text-white" for="member">
              <strong>Leden</strong>
            </label>
          </div>

          <div class="form-check m-1">
            <input class="form-check-input" type="checkbox" value="management" id="management" name="include_members[]" style="width: 20px; height: 20px">
            <label class="form-check-label text-white" for="management">
              <strong>Bestuurs leden</strong>
            </label>
          </div>

          <div class="form-check m-1">
            <input class="form-check-input" type="checkbox" value="donor" id="donor" name="include_members[]" style="width: 20px; height: 20px">
            <label class="form-check-label text-white" for="donor">
              <strong>Donateurs</strong>
            </label>
          </div>

          <div class="form-check m-1">
            <input class="form-check-input" type="checkbox" value="not_paid" id="not_paid" name="include_members[]" style="width: 20px; height: 20px">
            <label class="form-check-label text-white" for="not_paid">
              <strong>Niet betaalden</strong>
            </label>
          </div>
          <button type="submit" id="submit" class="btn text-white mt-2" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Exporteer</button>
        </form>
      </div>

      <!-- TABLE -->
      <div class="col">
        <!-- Filters -->
        <div class="row">
          <div class="col mr-2 mt-2">
            <div class="mb-4 float-start">
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

        <div class="">
          <table class="table table-custom-dark text-white">
            <thead>
            <tr>
              <th class="text-white" scope="col">ID</th>
              <th class="text-white" scope="col">Bestandsnaam</th>
              <th class="text-white" scope="col">Gemaakt op</th>
              <th class="text-white" scope="col">Gemaakt door</th>
              <th class="text-white" scope="col">Opties</th>
            </tr>
            </thead>
            <tbody >
            @foreach ($usersExport as $export)
              <tr>
                <th class="text-white" scope="row">
                  {{ $export->id }}
                </th>
                <td class="text-white">
                  {{ $export->file_name }}
                </td>

                <td class="text-white">
                {{ App\Helpers\refactorDate::refactorDate($export->made_on) }}
                <td class="text-white">
                  {{ $export->made_by }}
                </td>
                <td class="text-white">
                  <div style="display: flex;">
                    <form action="users-export/download/{{ $export->file_name }}" method="GET" style="margin-right: 10px;">
                      @csrf
                      <button type="submit" class="table-link text-info" style="border: none; background: none; padding: 0; cursor: pointer;">
                        <x-heroicon-o-arrow-down-tray stroke="white" style="width: 27px;" />
                      </button>
                    </form>

                    <form action="users-export/destroy/{{ $export->id }}" method="GET" id="delete-form-1">
                      @csrf
                      <button type="submit" class="table-link text-info"
                              onclick="return confirm('Weet je zeker dat je deze vlucht rapport wilt verwijderen?');"
                              style="border: none; background: none; padding: 0; cursor: pointer;">
                        <x-heroicon-o-trash stroke="white" style="width: 27px;" />
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>