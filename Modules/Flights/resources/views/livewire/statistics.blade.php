<div>
  <div class="container mb-3 mt-3">
    <select class="form-select" aria-label="" wire:change="updateSelectYear" wire:model="selectYear" style="width: 20%">
      @foreach ($yearsFlown as $year)
       <option value="{{ $year  }}">{{ $year }}</option>
      @endforeach
    </select>
  </div>

  <div class="container mt-3">
    <div class="row">
      <div class="col-md-6 text-center">
        <h2>Vluchten:</h2>
        <h2>{{ $totalFlightsCount }}</h2>
      </div>

      <div class="col-md-6 text-center">
        <h2>Leden:</h2>
        <h2>{{ $memberCount }}</h2>
      </div>

    </div>
  </div>

  <div class="container mt-3">
    <livewire:livewire-column-chart
      key="{{ $flightsThisYearCount->reactiveKey() }}"
      :column-chart-model="$flightsThisYearCount"
    />
  </div>

  <div class="container mt-3">
    <livewire:livewire-line-chart
      key="{{ $topTenPilots->reactiveKey() }}"
      :line-chart-model="$topTenPilots"
   />
  </div>

  <div class="container mt-3">
    <livewire:livewire-column-chart
      key="{{ $modelFlightsCount->reactiveKey() }}"
      :column-chart-model="$modelFlightsCount"
    />
  </div>

  @livewireStyles
  @livewireScripts
  @livewireChartsScripts
</div>