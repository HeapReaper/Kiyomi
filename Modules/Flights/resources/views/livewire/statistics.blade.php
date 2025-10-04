<div class="bg-dark bg-opacity-25 rounded m-2 p-2">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
  
  <div class="container mb-3 mt-3">
    <h2 class="text-white font-weight-bold">Vlucht statistieken</h2>
  </div>

  <div class="container mt-3">
    <h4 class="text-white">Totaal vluchten elk jaar</h4>
    <canvas id="flightsEachYear"></canvas>
  </div>

  <div class="container mt-3">
    <h4 class="text-white">Aantal vluchten per maand</h4>
    <canvas id="flightsEachMonth"></canvas>
  </div>

  <div class="container mt-3">
    <h4 class="text-white">Top 10 Piloten</h4>
    <canvas id="top10PilotsWithFlights"></canvas>
  </div>

  <div class="container mt-3">
    <h4 class="text-white">Modellen gevlogen</h4>
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
            plugins: {
              legend: {
                display: false,
                labels: { color: "#FFFFFF" }
              },
              tooltip: {
                bodyColor: "#FFFFFF",
                titleColor: "#FFFFFF"
              }
            },
            scales: {
              x: {
                ticks: { color: "#FFFFFF" },
                grid: { color: "rgba(255,255,255,0.2)" }
              },
              y: {
                ticks: { color: "#FFFFFF" },
                grid: { color: "rgba(255,255,255,0.2)" }
              }
            },
            
          };

          new Chart(document.getElementById("flightsEachYear"), {
            type: "bar",
            data: {
              labels: Object.keys(flightsEachYear),
              datasets: Object.entries(flightsEachYear).map(([year, count], index) => ({
                label: year,
                backgroundColor: barColors[index % barColors.length],
                data: [count]
              }))
            },
            options
          });

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
              type: "bar",
              data: {
                  labels: Object.keys(modelsFlownData),
                  datasets: [{
                      backgroundColor: barColors,
                      data: Object.values(modelsFlownData)
                  }]
              },
              options
          }));

      }

      document.addEventListener("DOMContentLoaded", function () {
        initCharts();
      });
  </script>
</div>
