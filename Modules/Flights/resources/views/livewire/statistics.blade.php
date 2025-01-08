<div>
  <div class="container mb-3 mt-3">
    <select class="form-select" aria-label="" wire:change="updateSelectYear" wire:model="selectYear" style="width: 20%">
      @for ($year = 2024; $year < 2029; $year++)
        @if ($year == Date('Y'))
          <option selected value="{{ $year }}">{{ $year }}</option>
        @else
          <option value="{{ $year }}">{{ $year }}</option>
        @endif
      @endfor
    </select>
  </div>

  <div class="container mt-3">
    <div class="row">
      <div class="col-md-6 text-center text-white">
        <h2>Vluchten:</h2>
        <h2>{{ $totalFlightsCount }}</h2>
      </div>

      <div class="col-md-6 text-center text-white">
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

  <style>
    .form-select {
      background-color: rgba(255, 255, 255, 0.1) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      border-radius: 5px !important;
      padding: 10px !important;
      color: white !important;
      font-size: 14px !important;
    }

    .form-select::placeholder {
      color: white !important;
    }

    .form-select:focus {
        color: white !important;
    }

    .form-select option {
        color: #000000;
        padding: 8px 16px;
        border: 1px solid transparent;
        border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
        cursor: pointer;
    }

    .form-control option:hover {
        background-color: #d53131 !important;
        color: white !important;
    }

    .form-select:after {
      position: absolute !important;
      content: "" !important;
      top: 14px !important;
      right: 10px !important;
      width: 0 !important;
      height: 0 !important;
      border: 6px solid !important;
      border-color: #fff !important;
    }

    .form-select:focus::placeholder {
        color: transparent !important;
    }

    .form-select-input:checked {
        background-color: green;
        border-color: #2b5c93;
    }
  </style>

  @livewireStyles
  @livewireScripts
  @livewireChartsScripts
</div>