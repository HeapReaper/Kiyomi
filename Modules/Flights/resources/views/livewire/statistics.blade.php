<div>
  <!-- Pre loader -->
  <div id="preloader">
    <div class="plane-container">
      <div class="plane">
      </div>
    </div>
  </div>
  
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
    
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.94);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      overflow: hidden;
      transition: opacity 2s ease;
    }
    
    #preloader.hidden {
      opacity: 0;
    }
    
    .plane-container {
      position: relative;
      width: 100%;
      height: 100px;
    }

    .plane {
      position: absolute;
      left: -100px;
      top: 30%;
      width: 600px;
      height: 275px;
      background-image: url('/app_media/fun-jet.png');
      background-size: contain;
      background-repeat: no-repeat;
      animation: flyAcross 4s linear infinite;
    }

    @keyframes flyAcross {
      0% {
        transform: translateX(100vw) rotate(0deg);
      }
      50% {
        transform: translateX(50vw) rotate(-10deg);
      }
      100% {
        transform: translateX(-100px) rotate(0deg);
      }
    }

    #content {
      display: none;
      padding: 20px;
      text-align: center;
    }
  </style>

  @livewireStyles
  @livewireScripts
  @livewireChartsScripts
  
  <script>
    window.addEventListener('load', () => {
      const preloader = document.getElementById('preloader');
      
      setTimeout(() => {
        preloader.classList.add('hidden');
      }, 2000);
  
      preloader.addEventListener('transitionend', () => {
        preloader.style.display = 'none';
      });
    });
  </script>
</div>