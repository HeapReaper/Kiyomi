<div>
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
          <th class="text-white" scope="col">Bestand naam</th>
          <th class="text-white" scope="col">Rapport start datum</th>
          <th class="text-white" scope="col">Rapport eind datum</th>
          <th class="text-white" scope="col">Gemaakt door</th>
          <th class="text-white" scope="col">Gemaakt op</th>
          <th class="text-white" scope="col">Opties</th>
        </tr>
      </thead>
      <tbody >
        @foreach ($flightReports as $report)
          <tr>
            <th class="text-white" scope="row">
              {{ $report->file }}
            </th>
            <td class="text-white">
              {{ App\Helpers\refactorDate::refactorDate($report->report_start_date) }}
            </td>
            <td class="text-white">
              {{ App\Helpers\refactorDate::refactorDate($report->report_end_date) }}
            </td>
            <td class="text-white">
              {{ $report->made_by }}</td>
            <td class="text-white">
              {{ $report->created_at->format('d-m-Y') }}
            </td>
            <td class="text-white">
              <div style="display: flex;">
                <form action="flights-reports/download/{{ $report->file }}" method="GET" style="margin-right: 10px;">
                  @csrf
                  <button type="submit" class="table-link text-info image-hover-resize-10" style="border: none; background: none; padding: 0; cursor: pointer;">
                    <x-heroicon-o-arrow-down-tray stroke="white" style="width: 27px;" />
                  </button>
                </form>

                <form action="flights-reports/destroy/{{ $report->id }}" method="GET" id="delete-form-{{ $report->id }}">
                  @csrf
                  <button type="submit" class="table-link text-info image-hover-resize-10"
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

    {{ $flightReports->links('pagination::bootstrap-5') }}
  </div>
</div>
