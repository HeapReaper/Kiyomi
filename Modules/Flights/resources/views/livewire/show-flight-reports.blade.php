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
    <table class="table rounded text-white">
      <thead>
        <tr>
          <th scope="col">Bestand naam</th>
          <th scope="col">Rapport start datum</th>
          <th scope="col">Rapport eind datum</th>
          <th scope="col">Gemaakt door</th>
          <th scope="col">Gemaakt op</th>
          <th scope="col">Opties</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($flightReports as $report)
          <tr>
            <th scope="row" style="">{{ $report->file }}</th>
            <td>{{ App\Helpers\refactorDate::refactorDate($report->report_start_date) }}</td>
            <td>{{ App\Helpers\refactorDate::refactorDate($report->report_end_date) }}</td>
            <td>{{ $report->made_by }}</td>
            <td>{{ $report->created_at->format('d-m-Y') }}</td>
            <td>
              <a href="flights-reports/download/{{ $report->file }}" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">
                Download
              </a>
              <a href="flights-reports/destroy/{{ $report->id }}" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)"
                 onclick="return confirm('Weet je zeker dat je deze vlucht rapportage wilt verwijderen?')"
              >
                Verwijder
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $flightReports->links('pagination::bootstrap-5') }}
  </div>
</div>
