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

  @livewireStyles
  @livewireScripts
  @livewireChartsScripts

  <script>
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
    ];

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