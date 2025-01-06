<div>
  <div class="mb-3 mt-3">
    <select class="form-select" aria-label="" wire:change="updateSelectYear" wire:model="selectYear" style="width: 20%">
      <option value="2024">2024</option>
      <option value="2025">2025</option>
    </select>
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
  @livewireStyles
  @livewireScripts
  @livewireChartsScripts
</div>