<div class=" bg-dark bg-opacity-25 rounded m-2 p-2">
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
  </script>
  <div class="container mb-3 mt-3">
    <h2 class="text-white font-weight-bold">Vlucht statistieken</h2>
  </div>

  <div class="container mt-3">
    <h2 class="text-white">Aantal vluchten per maand</h2>
    <canvas id="flightsEachMonth" style="width:100%;max-width:700px; color:white;"></canvas>
  </div>

  <div class="container mt-3">
    <h2 class="text-white">Top 10 Piloten</h2>
    <canvas id="top10PilotsWithFlights" style="width:100%;max-width:700px; color:white;"></canvas>
  </div>

  <div class="container mt-3">
    <h2 class="text-white">Modellen gevlogen</h2>
    <canvas id="modelsFlown" style="width:100%;max-width:700px; color:white;"></canvas>
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
      // Reusable options object
      const options = {
          responsive: true,
          maintainAspectRatio: true,
          legend: {
              labels: {
                  fontColor: '#FFFFFF'
              }
          },
          scales: {
              xAxes: [{
                  ticks: {
                      fontColor: '#FFFFFF'
                  }
              }],
              yAxes: [{
                  ticks: {
                      fontColor: '#FFFFFF'
                  }
              }]
          },
          tooltips: {
              bodyFontColor: '#FFFFFF',
              titleFontColor: '#FFFFFF'
          }
      };

      const months = [
          "Januari",
          "Februari",
          "Maart",
          "April",
          "Mei",
          "Juni",
          "Juli",
          "Augustus",
          "September",
          "Oktober",
          "November",
          "December"
      ];

      const barColors= [
          "red",
          "green",
          "blue",
          "orange",
          "brown",
          "purple",
          "cyan",
          "magenta",
          "lime",
          "teal",
          "pink",
          "gold"
      ];

      const models = [
          "Vliegtuig",
          "Motorzweefvliegtuig",
          "Zweefvliegtuig",
          "Helikopter",
          "Drone",
      ]

      const flightsEachMonthData = @json($flightsThisYearCount);
      const top10PilotsData = @json($topTenPilots);
      const modelsFlownData = @json($modelFlightsCount);

      new Chart("flightsEachMonth", {
          type: "bar",
          data: {
              labels: months,
              datasets: [{
                  backgroundColor: barColors,
                  data: months.map(month => flightsEachMonthData[month] ?? 0)
              }]
          },
          options: options
      });

      new Chart("top10PilotsWithFlights", {
          type: "bar",
          data: {
              labels: Object.keys(top10PilotsData),
              datasets: [{
                  backgroundColor: barColors,
                  data: Object.values(top10PilotsData)
              }]
          },
          options: options
      });

      new Chart("modelsFlown", {
          type: "pie",
          data: {
              labels: models,
              datasets: [{
                  backgroundColor: barColors,
                  data: models.map(model => modelsFlownData[model] ?? 0)
              }]
          },
          options: options
      });
  </script>
</div>