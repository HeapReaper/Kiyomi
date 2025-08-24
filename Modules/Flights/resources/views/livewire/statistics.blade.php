<div class="bg-dark bg-opacity-25 rounded m-2 p-2">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

  <div class="container mb-3 mt-3">
    <h2 class="text-white font-weight-bold">Vlucht statistieken</h2>
  </div>

  <div class="container mt-3">
    <h2 class="text-white">Totaal vluchten elk jaar</h2>
    <canvas id="flightsEachYear"></canvas>
  </div>

  <div class="container mt-3">
    <h2 class="text-white">Aantal vluchten per maand</h2>
    <canvas id="flightsEachMonth"></canvas>
  </div>

  <div class="container mt-3">
    <h2 class="text-white">Top 10 Piloten</h2>
    <canvas id="top10PilotsWithFlights"></canvas>
  </div>

  <div class="container mt-3">
    <h2 class="text-white">Modellen gevlogen</h2>
    <canvas id="modelsFlown"></canvas>
  </div>

  <script>
      let charts = [];

      function initCharts() {
          const flightsEachYear     = @json($flightsEachYear);
          const flightsEachMonthData= @json($flightsThisYearCount);
          const top10PilotsData     = @json($topTenPilots);
          const modelsFlownData     = @json($modelFlightsCount);

          const months = [
            "Januari","Februari","Maart","April","Mei","Juni",
            "Juli","Augustus","September","Oktober","November","December"
          ];

          const barColors = [
            "red","green","blue","orange","brown","purple",
            "cyan","magenta","lime","teal","pink","gold"
          ];

          const models = ["Vliegtuig","Motorzweefvliegtuig","Zweefvliegtuig","Helikopter","Drone"];

          const options = {
            responsive: true,
            maintainAspectRatio: true,
            legend: { labels: { fontColor: '#FFFFFF' }},
            scales: {
              xAxes: [{ ticks: { fontColor: '#FFFFFF' }}],
              yAxes: [{ ticks: { fontColor: '#FFFFFF' }}]
            },
            tooltips: {
              bodyFontColor: '#FFFFFF',
              titleFontColor: '#FFFFFF'
            }
          };

          charts.push(new Chart(document.getElementById("flightsEachYear").getContext("2d"), {
            type: "bar",
            data: {
              labels: Object.keys(flightsEachYear),
              datasets: [{ backgroundColor: barColors, data: Object.values(flightsEachYear) }]
            },
            options
          }));

          charts.push(new Chart(document.getElementById("flightsEachMonth").getContext("2d"), {
            type: "bar",
            data: {
              labels: months,
              datasets: [{
                backgroundColor: barColors,
                data: months.map(m => flightsEachMonthData[m] ?? 0)
              }]
            },
            options
          }));

          charts.push(new Chart(document.getElementById("top10PilotsWithFlights").getContext("2d"), {
            type: "bar",
            data: {
              labels: Object.keys(top10PilotsData),
              datasets: [{ backgroundColor: barColors, data: Object.values(top10PilotsData) }]
            },
            options
          }));

          charts.push(new Chart(document.getElementById("modelsFlown").getContext("2d"), {
            type: "pie",
            data: {
              labels: models,
              datasets: [{
                backgroundColor: barColors,
                data: models.map(m => modelsFlownData[m] ?? 0)
              }]
            },
            options
          }));
      }

      document.addEventListener("turbo:load", function () {
        initCharts();
      });

      document.addEventListener("turbo:before-cache", function () {
        charts.forEach(c => c.destroy());
        charts = [];
      });
  </script>
</div>
